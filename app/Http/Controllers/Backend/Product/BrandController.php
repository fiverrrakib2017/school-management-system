<?php
namespace App\Http\Controllers\Backend\Product;
use App\Http\Controllers\Controller;
use App\Models\Product_Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){
        $data=Product_Brand::latest()->get();
        return view('Backend.Pages.Product.Brand.index',compact('data'));
    }
    public function create(){
        return view('Backend.Pages.Product.Brand.Add');
    }
    public function store(Request $request){
         //Validate the form data
        $rules = [
            'brand_name' => 'required|string',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string',
            'status' => 'required|in:1,0',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }
        // Handle file upload
        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Backend/uploads/photos'), $imageName);
        }else{
            $imageName =NULL;
        }

        // Create a new brand object
        $brand = new Product_Brand();
        $brand->brand_name=$request->brand_name;
        $brand->brand_image=$imageName;
        $brand->slug=$request->slug;
        $brand->status=$request->status;
        // Save the brand to the database
        $brand->save();
         // Redirect or return a response as needed
        return redirect()->route('admin.brand.index')->with('success','Add Successfully');
    }
    public function edit($id){
         $data = Product_Brand::findOrFail($id);
        return view('Backend.Pages.Product.Brand.Update', compact('data'));
    }
    public function update(Request $request)
    {
        // Validation rules
        $rules = [
            'brand_name' => 'required|string',
            'brand_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string',
            'status' => 'required|in:1,0',
        ];
    
        // Validate the request
        $validator = Validator::make($request->all(), $rules);
    
        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }
    
        // Find the brand by ID
        $brand = Product_Brand::find($request->id);
    
        // Check if the brand exists
        if (!$brand) {
            return redirect()->back()->with('error', 'Brand not found')->withInput();
        }
    
        // Update brand details
        $brand->brand_name = $request->brand_name;
    
        // Handle the image upload if a new image is provided
        if ($request->hasFile('brand_image')) {
            // Delete the existing image
            if ($brand->brand_image && file_exists(public_path('Backend/uploads/photos/' . $brand->brand_image))) {
                File::delete(public_path('Backend/uploads/photos/' . $brand->brand_image));
            }
    
            // Upload and save the new image
            $image = $request->file('brand_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Backend/uploads/photos'), $imageName);
            $brand->brand_image = $imageName;
        }
    
        // Update other fields
        $brand->slug = $request->slug;
        $brand->status = $request->status;
    
        // Save the updated brand
        $brand->update();
    
        // Redirect with success message
        return redirect()->route('admin.brand.index')->with('success', 'Brand updated successfully');
    }
    
    public function delete($id){

        $object = Product_Brand::findOrFail($id);

        // Delete the brand image
        if ($object->brand_image!=NULL) {
            File::delete(public_path('Backend/uploads/photos/' . $object->brand_image));
        }


        // Delete the brand from the database
        $object->delete();
        return redirect()->route('admin.brand.index')->with('success','Delete Successfull');
    }
}
