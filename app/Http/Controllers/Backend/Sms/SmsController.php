<?php
namespace App\Http\Controllers\Backend\Sms;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Message_template;
use App\Models\Pop_area;
use App\Models\Pop_branch;
use App\Models\Section;
use App\Models\Send_message;
use App\Models\Sms_configuration;
use App\Models\Student;
use App\Models\Student_class;
use App\Models\Ticket;
use App\Models\Zkteco_sms_settings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\send_message;

class SmsController extends Controller
{
    public function config()
    {
       $data= Sms_configuration::latest()->first();
        return view('Backend.Pages.Sms.Config',compact('data'));
    }
    public function sms_template_list()
    {

        return view('Backend.Pages.Sms.Template');
    }
    public function message_send_list()
    {
        return view('Backend.Pages.Sms.Send_list');
    }
    public function bulk_message_send_list(){
        $sections= Section::latest()->get();
        return view('Backend.Pages.Sms.Bulk_send_list',compact('sections'));
    }
    public function biometric_message_settings()
    {
        $data = Zkteco_sms_settings::latest()->first();
        return view('Backend.Pages.Sms.Biometric.Settings', compact('data'));
    }
    public function biometric_message_settings_store(Request $request)
    {
        /*Validate the form data*/
        $rules = [
            'sms_enable' => 'nullable|in:1',
            'status_present' => 'nullable|in:Present',
            'status_absent' => 'nullable|in:Absent',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        /* Create a new Instance*/
        $object = Zkteco_sms_settings::firstOrNew([]);
        $object->sms_enable = $request->has('sms_enable') ? 1 : 0;
        $object->on_present = $request->status_present == 'Present' ? 1 : 0;
        $object->on_absent = $request->status_absent == 'Absent' ? 1 : 0;
        $object->present_template = $request->present_template ? $request->present_template : '';
        $object->absent_template = $request->absent_template ? $request->absent_template : '';

        /* Save to the database table*/
        $object->save();
        return response()->json([
            'success' => true,
            'message' => 'Added successfully!',
        ]);
    }
    public function sms_template_get_all_data(Request $request)
    {
        $search = $request->search['value'];
        $columnsForOrderBy = ['id',  'name', 'message'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $query = Message_template::when($search, function ($query) use ($search) {
            $query
                ->where('name', 'like', "%$search%")
                ->orWhere('message', 'like', "%$search%");
        });

        $total = $query->count();

        $query = $query->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);

        $items = $query->skip($request->start)->take($request->length)->get();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items,
        ]);
    }
    public function sms_template_get($id){
        $data = Message_template::find($id);
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
    public function sms_template_update(Request $request)
    {
        /*Validate the form data*/
        $rules = [
            'name' => 'required|string',
            'message' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        /* Get the object */
        $object = Message_template::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Not found.'], 404);
        }

        /* Update the object */
        $object->name = $request->name;
        $object->message = $request->message;

        /* Save to the database table*/
        $object->save();
        return response()->json([
            'success' => true,
            'message' => 'Updated successfully!',
        ]);
    }
    public function config_store(Request $request)
    {
       /*Validate the form data*/
       $rules = [
            'api_url' => 'required|string',
            'api_key' => 'required|string',
            'sender_id' => 'required|string',
            'default_country_code' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        /* Create a new Instance*/
        $object = Sms_configuration::firstOrNew([]);
        $object->api_url = $request->api_url;
        $object->api_key = $request->api_key;
        $object->sender_id = $request->sender_id;
        $object->default_country_code = $request->default_country_code;

        /* Save to the database table*/
        $object->save();
        return response()->json([
            'success' => true,
            'message' => 'Added successfully!',
        ]);
    }

    public function sms_template_Store(Request $request){

        /*Validate the form data*/
       $rules = [
        'name' => 'required|string',
        'message' => 'required|string',
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json(
            [
                'success' => false,
                'errors' => $validator->errors(),
            ],
            422,
        );
    }
     /* Create a new Instance*/
     $object =new Message_template();
     $object->name = $request->name;
     $object->message = $request->message;

     /* Save to the database table*/
     $object->save();
     return response()->json([
         'success' => true,
         'message' => 'Added successfully!',
     ]);

    }
    public function send_message_store(Request $request){
        /*Validate the form data*/
        $rules = [
            'message' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        if(empty($request->student_ids) && isset($request->student_ids)){
            return response()->json(['success'=>false, 'message'=>'Student Not Found']);
        }
        foreach($request->student_ids as $student_id){
            $student=Student::find($student_id);
            /* Create a new Instance*/
            $object =new Send_message();
            $object->student_id = $student->id;
            $object->class_id = $student->current_class ;
            $object->section_id = $student->section_id ;
            $object->message = $request->message;
            $object->sent_at = Carbon::now();



            /*Call Send Message Function */
            $response=send_message($student->phone, $request->message);
                if (isset($response['response_code']) && $response['response_code'] == '202') {
                    $object->status = 1;
                } else {
                    $object->status = 0;
                }
            /* Save to the database table*/
            $object->save();
        }


        return response()->json([
            'success' => true,
            'message' => 'Added successfully!',
        ]);
    }
    public function send_message_get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'pop_id', 'name', 'message'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $query = Send_message::with(['pop','customer'])->when($search, function ($query) use ($search) {
            $query
                ->where('message', 'like', "%$search%")
                // ->orWhere('message', 'like', "%$search%")
                ->orWhereHas('pop', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->orWhereHas('customer', function ($query) use ($search) {
                    $query->where('fullname', 'like', "%$search%");
                    $query->where('username', 'like', "%$search%");
                });
        });

        $total = $query->count();

        $query = $query->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);

        $items = $query->skip($request->start)->take($request->length)->get();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $items,
        ]);
    }
    public function sms_template_delete(Request $request)
    {
        $object = Message_template::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Not found.'], 404);
        }

        /* Delete it From Database Table */
        $object->delete();

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
    public function send_message_delete(Request $request){
        $object = Send_message::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Not found.'], 404);
        }

        /* Delete it From Database Table */
        $object->delete();

        return response()->json(['success' => true, 'message' => 'Deleted successfully.']);
    }
    /*********************** SMS Logs   ******************************/
    public function sms_logs(){
        $classes = Student_class::latest()->get();
        $sections = Section::latest()->get();
        return view('Backend.Pages.Sms.Logs',compact('classes', 'sections'));
    }
    public function get_all_sms_logs_data(Request $request)
{
    $class_id = $request->class_id;
    $section_id = $request->section_id;
    $search = $request->search['value'];
    $columnsForOrderBy = ['id', 'class_id', 'section_id', 'name', 'roll_no', 'phone', 'sent_at', 'message'];
    $orderByColumn = $request->order[0]['column'];
    $orderDirectection = $request->order[0]['dir'];


    $query = Send_message::with(['student.currentClass', 'student.section']);

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('message', 'like', "%$search%")
              ->orWhereHas('student.currentClass', function ($q) use ($search) {
                  $q->where('name', 'like', "%$search%");
              })
              ->orWhereHas('student.section', function ($q) use ($search) {
                  $q->where('name', 'like', "%$search%");
              });
        });
    }

    if ($class_id) {
        $query->where('class_id', $class_id);
    }

    if ($section_id) {
        $query->where('section_id', $section_id);
    }
     if ($request->from_date) {
        $query->whereDate('created_at', '>=', $request->from_date);
    }

    if ($request->to_date) {
        $query->whereDate('created_at', '<=', $request->to_date);
    }

    $total = $query->count();

    $items = $query->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection)
                   ->skip($request->start)
                   ->take($request->length)
                   ->get();

    return response()->json([
        'draw' => $request->draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $items,
    ]);
}

    /*********************** SMS Report   ******************************/
    public function sms_report(){
          return view('Backend.Pages.Sms.Report');
    }

}
