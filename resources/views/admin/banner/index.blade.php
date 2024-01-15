@extends('admin.layouts.master')
@section('title')
    Banner Images
@endsection
@section('main-content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>All Banner Image
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Images</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        @if ($images != null)
                            <p style="margin-top: 10px">Already Add Images</p>
                        @else
                        <a type="button" class="btn btn-primary" href="{{route('adminBanner.add')}}">Add Images</a>
                        @endif
            </ul>
            
            <div class="clearfix"></div>
          </div>
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
          <div class="x_content">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">
           @if ($images->count() > 0 )
               
           <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                  <th>Banner Images</th>
                  <th>Slider Images</th>
                  
                </tr>
              </thead>


              <tbody>
                @foreach ($images as $image)
                
                <tr>
                   <td>
                            <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                                
                                    <img class="image-thumbnail" src="{{ asset($image->banner_image) }}" alt=""
                                    style="width: 60px;height: 60px;margin-right: 10px;"
                                    >
                            </div>
                        </td>
                        <td>
                        <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                            @foreach (json_decode($image->slider_images) as $img)
                            {{-- {{ $img }} --}}
                            <img class="image-thumbnail" src="{{ asset($img) }}" alt=""
                            style="width: 60px;height: 60px;margin-right: 10px;"
                            >
                            @endforeach
                        </div>

                    </td>
                   <td>
                    <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                      @php
                            $idencrypt = Crypt::encrypt($image->id);
                            @endphp
                        <a type="button" class="btn btn-primary" href="{{route('adminBanner.edit',['id' => $idencrypt])}}">Edit Category</a>
                          {{-- <form action="{{route('adminCategory.delete',['id' => $idencrypt])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="color: white" 
                            onclick="return confirm('If This Category is deleted than all of its product are also be deleted!!Are You Sure?')">Delete Category</button> 
                          </form> --}}
                    </div>
                    </td>
                    
                  </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <p style="text-align: center ; font-size: 30px; color: red"><b>No Records Found</b></p>
            @endif
                
            {{-- {{$allCategories->links()}} --}}
            {{-- {{ $allCategories->appends(request()->input())->links() }} --}}
            {{-- {{$allCategories->links('pagination::bootstrap-4')}} --}}
           
          </div>
        </div>
      </div>
    </div>
        </div>
      </div>

    </div>
  </div>
@endsection