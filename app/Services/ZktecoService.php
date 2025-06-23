<?php
namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ZktecoService
{
    /**
     * Get the authentication token for BioTime API.
     *
     * @return string
     * @throws \Exception
     */
    public static function get_token()
    {
        if (Cache::has('biotime_token')) {
            return Cache::get('biotime_token');
        }
        $response = Http::post(config('zkteco.api_url') . '/' . 'jwt-api-token-auth/', [
            'username' => config('zkteco.username'),
            'password' => config('zkteco.password'),
        ]);

        if ($response->successful()) {
            $token = 'JWT ' . $response->json()['token'];
            Cache::put('biotime_token', $token, now()->addMinutes(50));

            return $token;
        }

        throw new \Exception('Failed to authenticate with BioTime.');
    }
    public static function add_employee($request)
    {
        /*Check Zkteco Device enable And Card No*/
        if ($request->include_zkteco_device == 'enable' && $request->zkteco_device_card_no == null) {
            return response()->json([
                'success' => false,
                'message' => 'Card No is required when ZKTeco device is enabled.',
            ]);
        }

        /* Check if the ZKTeco API is enabled */
        if ($request->include_zkteco_device == 'enable' && $request->code !== null && $request->code !== '') {

            /* Get the ZKTeco token */
            $token = self::get_token();
            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get ZKTeco token.',
                ]);
            }
            $extis_employee_res = Http::withHeaders([
                'Authorization' => $token,
                'Content-Type' => 'application/json',
            ])->get(config('zkteco.api_url').'/personnel/api/employees/?emp_code='.$request->code);

            if(empty($extis_employee_res->data)){

                /* Check if the ZKTeco token is available */
                if (!config('zkteco.api_url') || !config('zkteco.username') || !config('zkteco.password')) {
                    return response()->json([
                        'success' => false,
                        'message' => 'ZKTeco API configuration is missing.',
                    ]);
                }


                $zktecoResponse = Http::withHeaders([
                    'Authorization' => $token,
                    'Content-Type' => 'application/json',
                ])->post(config('zkteco.api_url') . '/personnel/api/employees/', [
                    'emp_code' => $request->code ?? time(),
                    'first_name' => $request->name,
                    'department' => config('zkteco.default_department'),
                    'area' => config('zkteco.default_area'),
                    'birth_date' => $request->birth_date ?? '2000-01-01',
                    'hire_date' => now()->toDateString(),
                    'card_no' => $request->zkteco_device_card_no,
                ]);


                if ($zktecoResponse->successful()) {
                    $biotimeUser = $zktecoResponse->json();

                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to sync with ZKTeco.',
                        'error' => $zktecoResponse->body(),
                    ]);
                }

                /*Zkteco sync */
                if (isset($biotimeUser['id'])) {
                    $resyncResponse = Http::withHeaders([
                        'Authorization' => $token,
                        'Content-Type' => 'application/json',
                    ])->post(config('zkteco.api_url') . '/personnel/api/employees/resync_to_device/', [
                        'employees' => [$biotimeUser['id']],
                    ]);
                    if (!$resyncResponse->successful()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Failed to sync to device.',
                            'zkteco_response' => $resyncResponse->body(),
                        ]);
                    }
                }

            }
        }

    }

    public static function delete_employee($id)
    {
        $token = self::get_token();
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get ZKTeco token.',
            ]);
        }

        $response = Http::withHeaders([
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->delete(config('zkteco.api_url') . '/personnel/api/employees/' . $id);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully.',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to delete employee.',
            'error' => $response->body(),
        ]);
    }
    public static function get_today_transactions()
    {
        $token = self::get_token();
        if (!$token) {
            return null; // অথবা false
        }

        $start = now()->startOfDay()->format('Y-m-d H:i:s');
        $end = now()->endOfDay()->format('Y-m-d H:i:s');

        $response = Http::withHeaders([
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->get(config('zkteco.api_url') . '/iclock/api/transactions/', [
            'start_time' => $start,
            'end_time' => $end,
            'page_size' => 1000,
        ]);

        if ($response->successful()) {
            return $response->json()['data'];
        }

        return null;
    }

    public static function get_employee($id)
    {
        $token = self::get_token();
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get ZKTeco token.',
            ]);
        }
        $response = Http::withHeaders([
            'Authorization' => $token,
            'Content-Type' => 'application/json',
        ])->get(config('zkteco.api_url') . '/personnel/api/employees/' . $id);
        if ($response->successful()) {
            return $response->json();
        }
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch employee data.',
            'error' => $response->body(),
        ]);
    }
}
