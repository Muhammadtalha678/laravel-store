@extends('admin.layouts.master')
@section('title')
    All Categories
@endsection
@section('main-content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>All categories
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <form action="{{route('adminCategory.search')}}" method="POST" role="search">
                @csrf
          <div class="input-group">
            <input type="text" name="search" value="{{session()->get('search')}}" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="submit">Go!</button>
            </span>
          </div>
        </form>
        </div>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Catgeories</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <a type="button" class="btn btn-primary" href="{{route('adminCategory')}}">Add Category</a>
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
           @if ($allCategories->count() > 0 )
               
           <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                  <th>Category Name</th>
                  <th>Category Images</th>
                  <th>Description</th>
                  <th>Created</th>
                  <th>Updated</th>
                  <th>Actions</th>
                  
                </tr>
              </thead>


              <tbody>
                @foreach ($allCategories as $category)
                
                <tr>
                  <td><b>{{$category->name}}</b></td>
                  @if ($category->images == null)
                        <td>Empty</td>
                     @else   
                        <td>
                            <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                                
                                    <img class="image-thumbnail" src="{{ asset($category->images) }}" alt=""
                                    style="width: 60px;height: 60px;margin-right: 10px;"
                                    >
                            </div>
                        </td>
                    @endif
                  @if ($category->desc == null)
                  <td>Empty</td>
                  @else 
                  <td>{{$category->desc}}</td>
                  @endif
                  <td>{{date('d-m-y',strtotime($category->created_at))}}</td>
                  <td>{{date('d-m-y',strtotime($category->updated_at))}}</td>
                  <td>
                    <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                      @php
                            $idencrypt = Crypt::encrypt($category->id);
                            @endphp
                        <a type="button" class="btn btn-primary" href="{{route('adminCategory.edit',['id' => $idencrypt])}}">Edit Category</a>
                          <form action="{{route('adminCategory.delete',['id' => $idencrypt])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="color: white" 
                            onclick="return confirm('If This Category is deleted than all of its product are also be deleted!!Are You Sure?')">Delete Category</button> 
                          </form>
                    </div>
                    </td>
                    
                  </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <p style="text-align: center ; font-size: 30px; color: red"><b>No Records Found</b></p>
            @endif
                
            {{$allCategories->links()}}
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
<script>
    document.addEventListener("keydown", function (event) {
        if (event.key === "F5") {
            // Clear the session value
            fetch('{{ route('clearSearchSession') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            });
        }
    });
</script>
