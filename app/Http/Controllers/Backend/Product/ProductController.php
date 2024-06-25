<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\Product_Brand;
use App\Models\Product_Category;
use App\Models\Product_child_category;
use App\Models\Product_image;
use App\Models\Product_sub_category;
use App\Models\Seller;
use App\Models\Size;
use App\Models\Temp_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    public function index(){
         $product=Product::with('product_image')->latest()->get();
        return view('Backend.Pages.Product.index',compact('product'));
    }
    public function get_product($id){
        return Product::with('product_image')->where(['id'=>$id])->latest()->get();
    }
    public function create(){
        $category=Product_Category::where('status',1)->latest()->get();
        $brand=Product_Brand::where('status',1)->latest()->get();
        $color=Color::where('status',1)->latest()->get();
        $size=Size::where('status',1)->latest()->get();
        return view('Backend.Pages.Product.Create',compact('category','brand','color','size'));
    }
    public function view($id){
        $product=Product::with('product_image','brand','category')->find($id);
        return view('Backend.Pages.Product.View',compact('product'));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), $this->validate_ruls());
        if($validator->passes()){
           $user=Auth::guard('admin')->user();
            $product = new Product;
            $product->user_id = $user->id;
            $product->title = $request->product_name;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_cat_id;
            $product->child_category_id = $request->child_cat_id;

            $product->size = implode(",",$request->size);
            $product->color =implode(",",$request->color);
            $product->tax = $request->tax;
            $product->delivery_charge = $request->delivery_charge;
            $product->product_type = $request->product_type;



            $product->slug = $request->slug;
            $product->p_price = $request->p_price;
            $product->s_price = $request->s_price;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;

            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = 'Yes';
            $product->qty = $request->qty;

            $product->status = $request->status;

            $product->save();

            /* save gallery pic*/
            if(!empty($request->image_array)){
                foreach($request->image_array as $temp_image_id){

                    $tempImageInfo = Temp_Image::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);

                    $productImage = new Product_image();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'Null';
                    $productImage->save();

                    $imageName = $product->id . '-' . $productImage->id.'-'.time().'.'.$ext;

                    $productImage->image =$imageName;
                    $productImage->save();

                    /*Generate Product Thumbnails*/
                    $sPath = public_path() . '/temp/' . $tempImageInfo->name;
                    $dPath = public_path() . '/uploads/product/' . $imageName;
                    

                    File::copy($sPath, $dPath);
                }
            }
            return response()->json([
                'status' => true,
                'message' => 'Product added succesfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function product_update(Request $request){

        $product= Product::find($request->id);
        if (empty($product)) {
            return response()->json(['success'=>false,'message'=>'Product Not Found']);
        }
        $validator = Validator::make($request->all(), $this->validate_ruls());
        if($validator->passes()){
            $user=Auth::guard('admin')->user();
             $product->user_id = $user->id;
             $product->title = $request->product_name;
             $product->brand_id = $request->brand_id;
             $product->category_id = $request->category_id;


             $product->size = implode(",",$request->size);
             $product->color =implode(",",$request->color);
             $product->tax = $request->tax;
             $product->delivery_charge = $request->delivery_charge;
             $product->product_type = $request->product_type;



             $product->slug = $request->slug;
             $product->p_price = $request->p_price;
             $product->s_price = $request->s_price;
             $product->description = $request->description;
             $product->short_description = $request->short_description;
             $product->shipping_returns = $request->shipping_returns;

             $product->sku = $request->sku;
             $product->barcode = $request->barcode;
             $product->track_qty = 'Yes';
             $product->qty = $request->qty;

             $product->status = $request->status;

             $product->update();


             return response()->json([
                'success' => true,
                'message' => 'Update Succesfully'
             ]);
         }else{
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
         }
    }
    public function delete(Request $request){
        $product=Product::find($request->id);
        if (empty($product)) {
            return redirect()->route('admin.products.index')->with('error','Product not found');
        }
        /* Product Image Find And Delete it From Database table */
        $product_image=Product_image::where(['product_id'=>$request->id])->get();
        if (!empty($product_image)) {
            foreach ($product_image as $productImage) {
                File::delete(public_path('uploads/product/'.$productImage->image));
            }
        }
        /* Now Delete Product Image Name Delete it From Database table */
        Product_image::where(['product_id'=>$request->id])->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Delete Success');
    }
    public function edit($id){
        $category=Product_Category::latest()->get();
        $brand=Product_Brand::latest()->get();
        $child_category=Product_child_category::latest()->get();
        $sub_category=Product_sub_category::latest()->get();
        $colors=Color::where('status', 1)->get();
        $sizes=Size::where('status',1)->get();
        $data=Product::with('product_image')->find($id);
        return view('Backend.Pages.Product.Update',compact('data','category','brand','sub_category','child_category','colors','sizes'));
    }
    public function photo_update(Request $request){
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $tempImageLocation = $image->getPathName();


        $productImage = new Product_image();
        $productImage->product_id = $request->product_id;
        $productImage->image = 'Null';
        $productImage->save();

        $imageName = $request->product_id . '-' . $productImage->id.'-'.time().'.'.$ext;
        $productImage->image = $imageName;
        $productImage->save();
        $image->move(public_path('uploads/product'), $imageName);

        return response()->json([
            'status' => true,
            'image_id' => $productImage->id,
            'imagePath' => asset('uploads/product/' . $productImage->image),
            'message' => 'Image saved successfully'
        ]);
    }
    public function delete_photo(Request $request){
        if ($request->type == "temp_file") {
            $product_image = Temp_Image::find($request->id);
            if (!empty($product_image)) {
                $imagePath = public_path() . '/temp/' . $product_image->name;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $product_image->delete();
                return response()->json(['success' => true, 'message' => 'Delete Successful']);
            }
        } else {
            /* Product Image Find And Delete it From Database table */
            $product_image = Product_image::find($request->id);
            if (!empty($product_image)) {
                $imagePath = public_path() . '/uploads/product/' . $product_image->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                /* Now Delete Product Image Name Delete it From Database table */
                $product_image->delete();
                return response()->json(['success' => true, 'message' => 'Delete Successful']);
            }
        }
        
        return response()->json(['success' => false, 'message' => 'Image not found']);
    }
    
    private function validate_ruls(){
            return  [
            'product_name' => 'required',
            'brand_id'=>'required',
            'category_id'=>'required',
            'slug' => 'nullable',
            'p_price' => 'required|numeric',
            's_price' => 'required|numeric',
            'description' => 'nullable|max:10000',
            'product_type' => 'required',
        ];
    }
}
