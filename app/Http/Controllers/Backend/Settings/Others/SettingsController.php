<?php

namespace App\Http\Controllers\Backend\Settings\Others;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Banner;
use App\Models\Website_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(){
        $data=Website_information::latest()->first();
        return view('Backend.Pages.Settings.School.information',compact('data'));
    }

    public function store(Request $request)
{
    //return $request->all();
    $request->validate([
        'school_name' => 'required|string|max:255',
        'address' => 'nullable|string|max:500',
        'phone_number' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $object = Website_information::firstOrNew([]);
    $object->name=$request->school_name;
    $object->address=$request->address;
    $object->phone_number=$request->phone_number;
    $object->email=$request->email;
    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Backend/uploads/photos/'), $imageName);
        $object->logo = $imageName;
    }
    $object->save();



    return back()->with('success', 'Settings updated successfully');
}




    public function edit($id)
    {
        $data = Achievement::find($id);
        if ($data) {
            return response()->json(['success' => true, 'data' => $data]);
            exit;
        } else {
            return response()->json(['success' => false, 'message' => 'Achievement not found.']);
        }
    }


    public function update(Request $request, $id)
    {

        $this->validateForm($request);

        $object = Achievement::findOrFail($id);
        $object->title = $request->title;
        $object->description = $request->description;
        if($request->hasFile('images')){
            /*Delete Previous Images*/
            $imagePath = public_path('Backend/uploads/photos/' . $object->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            /*Upload New Images*/
            $image = $request->file('images');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('Backend/uploads/photos/'),$imageName);
            $object->image = $imageName;
        }
        $object->update();

        return response()->json([
            'success' => true,
            'message' => 'Achievement Update successfully!'
        ]);
    }
    private function validateForm($request)
    {

        /*Validate the form data*/
        $rules=[
            'title' => 'required',
            'description' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    }

}
