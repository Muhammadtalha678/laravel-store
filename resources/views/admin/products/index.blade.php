@extends('admin.layouts.master')
@section('title')
    All Products
@endsection
@section('main-content')
<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>All Products
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <form action="{{route('adminProduct.search')}}" method="POST" role="search">
                @csrf
          <div class="input-group">
            <input type="text" name="search" value="{{session()->get('productSearch')}}" class="form-control" placeholder="Search for...">
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
                    <h2>Products</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <a type="button" class="btn btn-primary" href="{{route('adminProduct.add')}}">Add Product</a>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  
                  @if ($products->count() >0)
                  
                  <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                <tr>
                  <th>Product Name</th>
                  <th>Product Title</th>
                  <th>Product Description</th>
                  <th>Product SKU</th>
                  <th>Product Price</th>
                  <th>Product Quantity</th>
                  <th>Product Category</th>
                  <th>Product Discount</th>
                  <th>Product Thumbnail</th>
                  <th>Product Images</th>
                  <th>Product Videos</th>
                  <th>Product Created</th>
                  <th>Product Updated</th>
                  <th>Actions</th>
                  
                </tr>
              </thead>
              

              <tbody>
                @foreach ($products as $product)
                    
                <tr>
                    <td><b>{{$product->name}}</b></td>
                    
                    <td>{{$product->title}}</td>
                    <td>{{$product->subTitle}}</td>
                    <td>{{$product->SKU}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{$product->category_id}}</td>
                    <td>{{$product->discount}}</td>
                    <td>
                      <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                            <img class="image-thumbnail" src="{{ asset($product->thumbnail) }}" alt=""
                            style="width: 60px;height: 60px;margin-right: 10px;"
                            >
                    </div>
                      
                    </td>
                    @if ($product->images == null)
                        <td>Empty</td>
                     @else   
                        <td>
                            <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                                @foreach (json_decode($product->images) as $image)
                                    <img class="image-thumbnail" src="{{ asset($image) }}" alt=""
                                    style="width: 60px;height: 60px;margin-right: 10px;"
                                    >
                                @endforeach
                            </div>
                        </td>
                    @endif

                        @if ($product->videos == null)
                        <td>Empty</td>
                     @else   
                        <td>
                          @foreach (json_decode($product->videos) as $video)
                                    <video class="image-thumbnail" src="{{ asset($video) }}" alt=""
                                    style="width: 60px;height: 60px;margin-right: 10px;"
                                    >
                          @endforeach
                        </td>
                        @endif
                    <td>{{date('d-m-y',strtotime($product->created_at))}}</td>
                    <td>{{date('d-m-y',strtotime($product->updated_at))}}</td>
                    <td>
                      <div class="image-row" style="display: flex;flex-direction: row;align-items: center;">
                        @php
                              $idencrypt = Crypt::encrypt($product->id);
                              @endphp
                          <a type="button" class="btn btn-primary" href="{{route('adminProduct.edit',['id' => $idencrypt])}}">Edit Product</a>
                          <form action="{{route('adminProduct.delete',['id' => $idencrypt])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" style="color: white" 
                            onclick="return confirm('Are You Sure You Want To Delete This Product?')">Delete Category</button> 
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
           
                
            {{-- {{ $allCategories->appends(request()->input())->links() }} --}}
            {{-- {{$allCategories->links('pagination::bootstrap-4')}} --}}
            
          </div>
        </div>
      </div>
    </div>
    {{$products->links()}}
  </div>
      </div>

    </div>
  </div>
@endsection
<script>
  document.addEventListener("keydown", function (event) {
      if (event.key === "F5") {
          // Clear the session value
          fetch('{{ route('clearSearchSession.Product') }}', {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
              },
          });
      }
  });
</script>
