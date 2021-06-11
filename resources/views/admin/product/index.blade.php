@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product Tables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Product Tables</li>
            </ol>
          </div>
          <div class="row">

            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">DataTables with Hover</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Additional Info</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Action</th>
                        <th></th>
                      </tr>
                    </thead>
                   
                    <tbody>
                      @if(count($products)>0)
                        @foreach($products as $key=>$product)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td><img src="{{asset(Storage::url($product->image))}}" width="100"></td>
                        <td>{{$product->name}}</td>
                        <td>{!! $product->description !!}</td>
                        <td>{!! $product->additional_info !!}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->relCategory->name}}</td>
                        <td><a href="{{route('product.edit',[$product->id])}}"><button class='btn btn-info'>Edit</button></a></td>
                        <td>
                          <form action="{{route('product.destroy',[$product->id])}}" method="post" onsubmit="return confirmDelete()">
                          @csrf
                            {{method_field('Delete')}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                        @endforeach
                        
                      </tr>
                    @else
                    <td>No product created yet!</td>
                    @endif
                     

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

    </div>
                 
@endsection