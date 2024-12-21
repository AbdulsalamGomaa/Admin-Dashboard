<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\traits\media;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;

class ProductController extends Controller {

    use media;
    public function products() {

        $products = Product::all();
        return response()->json(compact('products'));
    }

    public function create() {

        $brands = Brand::select('id','name_en')->get();
        $subcategories = Subcategory::select('id','name_en')->get();
        return response()->json(compact('brands','subcategories'));
    }

    public function store(StoreProductRequest $request) {

        // filtering the data before uploading the image
        $data = $request->except('image');
        // upload image if it exists
        $imageName = $this->uploadImage($request->image,'products');
        $data['image'] = $imageName;
        // insert data in db
        Product::create($data);
        return response()->json(['Success'=>true,'Message'=>'Product has been created successfully']);
    }

    public function edit($id) {

        $products = Product::findOrFail($id);
        $brands = Brand::select('id','name_en')->get();
        $subcategories = Subcategory::select('id','name_en')->get();
        return response()->json(compact('products','brands','subcategories'));
    }

    public function update(UpdateProductRequest $request, $id) {

        // filtering the data before uploading the image
        $data = $request->except('image');
        // if image is exists
        if($request->has('image')) {
            // delete old image of product from storage
            $oldImageName = Product::find($id)->image;
            $imagePath = public_path('/dist/img/products/');
            $this->deleteImage($imagePath.$oldImageName);
            // upload the new product image to storage
            $imageName = $this->uploadImage($request->image,'products');
            $data['image'] = $imageName;
        }
        // update data in db
        Product::where('id', $id)->update($data);
        // redirect
        return response()->json(['Success'=>true,'Message'=>'Product has been updated successfully']);
    }

    public function delete($id) {
        // delete image of product from storage before deleting the product itself
        $oldImageName = Product::find($id)->image;
        $imagePath = public_path('/dist/img/products/');
        $this->deleteImage($imagePath.$oldImageName);
        // delete the product form db
        Product::where('id',$id)->delete();
        // redirect
        return response()->json(['Success'=>true,'Message'=>'Product has been deleted successfully']);
    }
}

