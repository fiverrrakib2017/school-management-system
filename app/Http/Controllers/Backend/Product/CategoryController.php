<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Product_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index(){
        $data=Product_Category::latest()->get();
        return view('Backend.Pages.Product.Category.index',compact('data'));
    }
    public function create(){
        return view('Backend.Pages.Product.Category.Add');
    }
    public function store(Request $request){
        $rules = [
            'category_name' => 'required|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string',
            'status' => 'required|in:1,0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }
        // Handle file upload
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Backend/uploads/photos'), $imageName);
        }else{
            $imageName =NULL;
        }

        // Create a new  object
        $object = new Product_Category();
        $object->category_name=$request->category_name;
        $object->category_image=$imageName;
        $object->slug=$request->slug;
        $object->status=$request->status;
        // Save the  to the database
        $object->save();
         // Redirect or return a response as needed
         return redirect()->route('admin.category.index')->with('success', 'Added successfully');
    }
    public function edit($id){
         $data = Product_Category::findOrFail($id);
        return view('Backend.Pages.Product.Category.Update',compact('data'));
    }
    public function update(Request $request){
        $rules = [
            'category_name' => 'required|string',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string',
            'status' => 'required|in:1,0',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

         $category=Product_Category::find($request->id);
         $category->category_name=$request->category_name;
         if ($request->hasFile('category_image')) {
            // Delete the existing image
            File::delete(public_path('Backend/uploads/photos/' . $category->category_image));

            // Upload and save the new image
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Backend/uploads/photos'), $imageName);
            $category->category_image = $imageName;
        }
        $category->slug=$request->slug;
        $category->status=$request->status;
        $category->update();

         return redirect()->route('admin.category.index')->with('success','Update Successfully');
    }
    public function delete(Request $request){

        $object = Product_Category::findOrFail($request->id);

        // Delete the brand image
        if ($object->category_image!=NULL) {
            File::delete(public_path('Backend/uploads/photos/' . $object->category_image));
        }


        // Delete the brand from the database
        $object->delete();
        return redirect()->route('admin.category.index')->with('success','Delete Successfull');
    }

}
