@extends('admin.layouts.master')
@section('title')
    Edit Banner Image
@endsection
@section('main-content')
    <div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Edit Images</h3>
        </div>

        
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Banner <small>Edit Images</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if (session('success'))
                    <div  id="errorMessage" class="alert alert-success text-center" style="color:white ; font-size: 16px">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div  id="errorMessage" class="alert alert-danger text-center" style="color: white ; font-size: 16px">
                        {{ session('error') }}
                    </div>
                    @endif
                    <br />
                    <form action="{{route('adminBanner.editStore')}}" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        @csrf
                        @method('patch')
                        @php
                            $idEncrypt = Crypt::encrypt($findData->id);
                        @endphp
                        <input type="hidden" name="id" value="{{$idEncrypt}}">
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Banner Thumbnail
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" name="banner_image" id="thumbnail" style="display: none">
                                <div class="thumbnail-preview mb-3 ml-3 mr-3 mt-3  " id="thumbnail-container">
                                    <a href="{{$findData->banner_image}}" target="_blank">
                                        <img style="width: 80px;height: 80px;margin-right: 10px;" src="{{ asset($findData->banner_image)}}" alt="">
                                    </a>
                                    </div>
                                    
                                
                                <button type="button" id="add-thumbnail-button">Edit Banner</button>
                                <script src="/thumbnail.js"></script>
                                @if ($errors->has('banner_image'))
                                <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->first('banner_image') }}
                                </div>                      
                                @endif
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Slider Images <span style="color: red">(4 images)</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input multiple type="file" name="slider_images[]" id="images"style="display: none">
                                <div class="images-preview mb-3 ml-3 mr-3 mt-3  " id="images-container">
                                    @foreach (json_decode($findData->slider_images) as $sliderImage)
                                        {{-- {{ $sliderImage }} --}}
                                    <a target="_blank" href="{{$sliderImage}}"><img style="width: 80px;height: 80px;margin-right: 10px;" src="{{ asset($sliderImage)}}" alt=""></a>
                                    @endforeach
                                    
                                </div>
                                
                                
                                <button type="button" id="add-images-button">Edit slider images</button>
                                <script src="/image.js"></script>
                                @if ($errors->has('slider_images'))
                                <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                    {{ $errors->first('slider_images') }}
                                </div>                      
                                @endif
                                @if ($errors->any())
                                @foreach ($errors->get('slider_images.*') as $key =>$sliderErrors)
                                @foreach ($sliderErrors as $key=>$error)
                                {{-- {{$error}} --}}
                                 <div  id="errorMessage" class="error" style="color: red ; font-size: 16px">
                                 {{$error}}
                             </div>
                                     
                                 @endforeach
                                @endforeach
    
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