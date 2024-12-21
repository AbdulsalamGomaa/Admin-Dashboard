@extends('admins.layouts.parent');

@section('title','Create Product');

@section('content')
    {{-- display errors messages --}}
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    {{-- display success messages --}}
    <div class="col-12">
        @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
    </div>
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row mb-2">
            <div class="col-6">
                <label for="name_en">Name En</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{old('name_en')}}" placeholder="" aria-describedby="helpId">
            </div>
            <div class="col-6">
                <label for="name_ar">Name Ar</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{old('name_ar')}}" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col-4">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{old('price')}}" placeholder="" aria-describedby="helpId">
            </div>
            <div class="col-4">
                <label for="code">Code</label>
                <input type="number" name="code" id="code" class="form-control" value="{{old('code')}}" placeholder="" aria-describedby="helpId">
            </div>
            <div class="col-4">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{old('quantity')}}" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col-4">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option {{old('status') == 1 ? 'selected' : ''}} value="1">Active</option>
                    <option {{old('status') == 0 ? 'selected' : ''}} value="0">Not Active</option>
                </select>
            </div>
            <div class="col-4">
                <label for="brands">Brands</label>
                <select name="brand_id" id="brands" class="form-control">
                    @foreach ($brands as $brand)
                        <option {{old('brand_id') == $brand->id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name_en}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-4">
                <label for="subcategories">Subcategories</label>
                <select name="subcategory_id" id="subcategories" class="form-control">
                    @foreach ($subcategories as $subcategory)
                        <option {{old('subcategory_id') == $subcategory->id ? 'selected' : ''}} value="{{$subcategory->id}}">{{$subcategory->name_en}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col-6">
                <label for="desc_en">Description EN</label>
                <textarea name="desc_en" id="desc_en" class="form-control" cols="30" rows="10">{{old('desc_en')}}</textarea>
            </div>
            <div class="col-6">
                <label for="desc_ar">Description Ar</label>
                <textarea name="desc_ar" id="desc_ar" class="form-control" cols="30" rows="10">{{old('desc_ar')}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="" aria-describedby="helpId">
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="col-2">
                <button class="btn btn-primary form-control"><strong>Create</strong></button>
            </div>
        </div>
    </form>
@endsection

