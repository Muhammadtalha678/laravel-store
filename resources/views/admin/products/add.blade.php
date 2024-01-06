@extends('admin.layouts.master')
@section('title')
    Add Product
@endsection
@section('main-content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Add Product</h3>
        </div>

        
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Product <small>Add Product</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if ($errors->any() )
                                <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                    <ul>

                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    {{-- {{ $errors->first('images') }} --}}
                                </div>                      
                                @endif
                    @if (session('success'))
                    <div  id="errorMessage" class="error  " style="color: green ; font-size: 16px">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div  id="errorMessage" class="error  " style="color: red ; font-size: 16px">
                        {{ session('error') }}
                    </div>
                    @endif
                    <br />
                    <form action="{{route('adminProduct.store')}}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Product Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="name" value="{{old('name')}}" id="first-name"  class="form-control ">
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Title
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="title" value="{{old('title')}}" class="form-control">
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Description
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea name="subTitle" id="text_field" rows="4" cols="50" class="form-control">{{old('subTitle')}}</textarea>
                                {{-- <input type="text" id="last-name" name="subTitle"  class="form-control"> --}}
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product SKU
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="SKU"  value="{{old('SKU')}}" class="form-control">
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Price
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="price" value="{{old('price')}}" class="form-control">
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Discount
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="discount"  value="{{old('discount')}}" class="form-control">
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Quantity
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="quantity" value="{{old('quantity')}}" class="form-control">
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Images
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" name="images[]" id="images" multiple style="display: none">
                                <div class="images-preview mb-3 ml-3 mr-3 mt-3  " id="images-container">
                                </div>
                                
                                
                                <button type="button" id="add-images-button">Add images</button>
                                <script src="/image.js"></script>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Thumbnail
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" name="thumnbail" id="thumbnail" style="display: none">
                                <div class="thumbnail-preview mb-3 ml-3 mr-3 mt-3  " id="thumbnail-container">
                                </div>
                                
                                
                                <button type="button" id="add-thumbnail-button">Add Thumbnail</button>
                                <script src="/thumbnail.js"></script>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Videos
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" name="videos[]" id="videos" multiple style="display: none">
                                <div class="videos-preview mb-3 ml-3 mr-3 mt-3  " id="videos-container">
                                </div>
                                
                                
                                <button type="button" id="add-videos-button">Add Videos</button>
                                <script src="/video.js"></script>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align ">Select Category</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select class="form-control" name="category">
                                    <option value="">Choose Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if(old('category') == $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                {{-- <button class="btn btn-primary" type="button">Cancel</button>
                                <button class="btn btn-primary" type="reset">Reset</button> --}}
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                    </div>
                        
                        
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection

