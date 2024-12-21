<?php

namespace App\Http\Controllers\admins\dashboard\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {

    use media;
    public function products() {
        // get the all products
        $products = DB::table('products')->select('id','name_en','code','price','status','quantity','created_at')->get();
        // pass products result in view
        return view('admins.dashboard.products.products',compact('products'));
    }

    public function create() {
        // get (id,name_en) of brands
        $brands = DB::table('brands')->select('id','name_en')->where('status', '=', '1')->get();
        // get (id,name_en) of subcategories
        $subcategories = DB::table('subcategories')->select('id','name_en')->where('status', '=', '1')->get();
        return view('admins.dashboard.products.create',compact('brands','subcategories'));
    }

    public function store(StoreProductRequest $request) { // <= data form comes her
        // filtering the data before uploading the image
        $data = $request->except('_token','image');
        // upload image if it exists
        $imageName = $this->uploadImage($request->image,'products');
        $data['image'] = $imageName;
        // insert data in db
        DB::table('products')->insert($data);
        // redirect
        return redirect()->back()->with('success','The product has been created successfully');
    }

    public function edit($id) {
        // get (id,name_en) of brands
        $brands = DB::table('brands')->select('id','name_en')->where('status', '=', '1')->get();
        // get (id,name_en) of subcategories
        $subcategories = DB::table('subcategories')->select('id','name_en')->where('status', '=', '1')->get();
        // get product as object
        $product = DB::table('products')->where('id',$id)->first(); // <= (first) helper gets the data as object
        return view('admins.dashboard.products.edit',compact('product','brands','subcategories'));
    }

    public function update(Request $request, $id) {
        // validation on inputs
        $rules = [
            'name_en' => ['required','string','max:256','min:2'],
            'name_ar' => ['required','string','max:256','min:2'],
            'code' => ['required','integer','digits:5',"unique:products,code,$id,id"],
            'price' => ['required','numeric','max:99999.99','min:5'],
            'quantity' => ['nullable','integer','max:999','min:1'],
            'status' => ['required','integer','between:0,1'],
            'brand_id' => ['required','integer','exists:brands,id'],
            'subcategory_id' => ['required','integer','exists:subcategories,id'],
            'desc_en' => ['required','string'],
            'desc_ar' => ['required','string'],
            // validation on (image) file
            'image' => ['nullable','max:100','mimes:jpg,png,jpeg']
        ];
        $request->validate($rules);
        // filtering the data before uploading the image
        $data = $request->except('_token','_method','image');
        // if image is exists
        if($request->has('image')) {
            // delete old image of product from storage
            $oldImageName = DB::table('products')->select('image')->where('id',$id)->first()->image;
            $imagePath = public_path('/dist/img/products/');
            $this->deleteImage($imagePath.$oldImageName);
            // upload the new product image to storage
            $imageName = $this->uploadImage($request->image,'products');
            $data['image'] = $imageName;
        }
        // update data in db
        DB::table('products')->where('id', $id)->update($data);
        // redirect
        return redirect()->back()->with('warning','The product has been updated successfully');
    }

    public function delete($id) {
        // delete image of product from storage before deleting the product itself
        $oldImageName = DB::table('products')->select('image')->where('id',$id)->first()->image;
        $imagePath = public_path('/dist/img/products/');
        $this->deleteImage($imagePath.$oldImageName);
        //delete the product form db
        DB::table('products')->where('id',$id)->delete();
        // redirect
        return redirect()->back()->with('danger','The product has been deleted successfully');
    }
}
