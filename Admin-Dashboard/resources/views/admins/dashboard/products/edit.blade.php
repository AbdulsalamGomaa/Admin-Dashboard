@extends('admins.layouts.parent');

@section('title','Edit Product');


@section('content')
    {{-- display success messages --}}
    <div class="col-12">
        @if(session()->has('warning'))
            <div class="alert alert-warning"><strong>{{ session()->get('warning') }}</strong></div>
        @endif
    </div>
    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row mb-2">
            <div class="col-6">
                <label for="name_en">Name En</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{$product->name_en}}" placeholder="" aria-describedby="helpId">
                @error('name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="name_ar">Name Ar</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{$product->name_ar}}" placeholder="" aria-describedby="helpId">
                @error('name_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col-4">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{$product->price}}" placeholder="" aria-describedby="helpId">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="code">Code</label>
                <input type="number" name="code" id="code" class="form-control" value="{{$product->code}}" placeholder="" aria-describedby="helpId">
                @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{$product->quantity}}" placeholder="" aria-describedby="helpId">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{$product->status == 1 ? 'selected' : ''}} value="1">Active</option>
                    <option {{$product->status == 0 ? 'selected' : ''}} value="0">Not Active</option>
                </select>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="brands">Brands</label>
                <select name="brand_id" id="brands" class="form-control">
                    @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name_en}}</option>
                    @endforeach
                </select>
                @error('brand_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <label for="subcategories">Subcategories</label>
                <select name="subcategory_id" id="subcategories" class="form-control">
                    @foreach ($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">{{$subcategory->name_en}}</option>
                    @endforeach
                </select>
                @error('subcategory_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col-6">
                <label for="desc_en">Description EN</label>
                <textarea name="desc_en" id="desc_en" class="form-control" cols="30" rows="10">{{$product->desc_en}}</textarea>
                @error('desc_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6">
                <label for="desc_ar">Description Ar</label>
                <textarea name="desc_ar" id="desc_ar" class="form-control" cols="30" rows="10">{{$product->desc_ar}}</textarea>
                @error('desc_ar')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="" aria-describedby="helpId">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-4">
                <img src="{{url('dist/img/products/'.$product->image)}}" alt="{{$product->name_en}}" class="w-100">
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col-2">
                <button class="btn btn-warning form-control"><strong>Update</strong></button>
            </div>
        </div>
    </form>
@endsection
