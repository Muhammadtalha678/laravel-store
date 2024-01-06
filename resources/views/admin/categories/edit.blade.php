@extends('admin.layouts.master')
@section('title')
    Edit Category
@endsection
@section('main-content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Category</h3>
        </div>

        
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Category <small>Edit Category</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
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
                    <form action="{{route('adminCategory.editStore')}}" enctype="multipart/form-data"  method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('patch')
                        @php
                            $idencrypt = Crypt::encrypt($categories->id);
                        @endphp
                        <input type="hidden" value="{{$idencrypt}}" name="id">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Category Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" name="name" id="first-name"  class="form-control " 
                                 value="{{$categories->name}}">
                                @if ($errors->has('name'))
                                <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->first('name') }}
                                </div>                      
                                @endif
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Product Images
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" name="images" id="images" 
                                   style="display: none">
                                <div class="images-preview mb-3   " id="images-container">
                                    @if ($categories->images)
                                        
                                            <img style="width: 80px;height: 80px;margin-right: 10px;" src="{{ asset($categories->images)}}" alt="">
                                    @else
                                    <p style="font-size: 16px ; "><b>No Image Found</b></p>
                                    @endif
                                </div>
                                
                                
                                <button type="button" id="add-images-button">Add images</button>
                                <script src="/image.js"></script>
                                @if ($errors->has('images'))
                                <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->first('images') }}
                                </div>                      
                                @endif
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Category Description (Optional)
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="desc"  class="form-control" 
                                 >
                                 @if ($errors->has('desc'))
                                <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->first('desc') }}
                                </div>                      
                                @endif
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

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection