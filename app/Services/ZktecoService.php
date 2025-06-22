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
        if($request->include_zkteco_device =='enabled' && $request->zkteco_device_card_no == null){
            return response()->json([
                'success' => false,
                'message' => 'Card No is required when ZKTeco device is enabled.'
            ]);
        }
        if ($request->include_zkteco_device =='enabled') {
            /* Check if the ZKTeco token is available */
            if (!config('zkteco.api_url') || !config('zkteco.username') || !config('zkteco.password')) {
                return response()->json([
                    'success' => false,
                    'message' => 'ZKTeco API configuration is missing.'
                ]);
            }

            /* Get the ZKTeco token */
            $token = self::get_token();
            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get ZKTeco token.'
                ]);
            }
            $zktecoResponse = Http::withHeaders([
                'Authorization' => $token,
                'Content-Type' => 'application/json',

            ])->post(config('zkteco.api_url').'/personnel/api/employees/', [

                'emp_code'      => $request->code ?? time(),
                'first_name'    => $request->name,
                'department'    => config('zkteco.default_department'),
                'area'          => config('zkteco.default_area'),
                'birth_date'    => $request->birth_date ?? '2000-01-01',
                'hire_date'     => now()->toDateString(),
                'card_no'      => $request->zkteco_device_card_no,
            ]);

            if ($zktecoResponse->successful()) {
                $biotimeUser = $zktecoResponse->json();

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Student created, but failed to sync with ZKTeco.',
                    'error' => $zktecoResponse->body()
                ]);
            }
            /*Zkteco sync */
            if (isset($biotimeUser['id'])) {
            $resyncResponse= Http::withHeaders([
                    'Authorization' =>$token,
                    'Content-Type' => 'application/json',
                ])->post(config('zkteco.api_url').'/personnel/api/employees/resync_to_device/', [
                    'employees' => [$biotimeUser['id']]
                ]);
                if (!$resyncResponse->successful()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to sync to device.',
                        'zkteco_response' => $resyncResponse->body()
                    ]);
                }
            }
        }
    }
}
