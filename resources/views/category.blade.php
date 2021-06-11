@extends('layouts.app')

@section('content')


    <div class="container">
        <h2>Products</h2>

      <div class="row">
        <div class="col-md-2">
             <form action="{{route('product.list',[$slug])}}" method="GET">
            <!--foreach subcategories-->
            @foreach($subcategory as $sub)
              <p><input type="checkbox" name="subcategory[]" value="{{$sub->id}}"
            @if(isset($filterSubcategories))
            {{in_array($sub->id,$filterSubcategories)?'checked="checked"':''}} @endif>{{$sub->name}}</p>
           <!--end foreach-->
           @endforeach
          <input type="submit" value="Filter" class="btn btn-success">
         </form>
         <hr>
         <h3>Filter By Price</h3>
         <form action="{{route('product.list',[$slug])}}" method="GET">
            <input type="text" name="min" class="form-control" placeholder="minimum price" 
            required="">
            <br>
            <input type="text" name="max" class="form-control" placeholder="maximun price" 
            required="">
            <input type="hidden" name="categoryId" value="{{$categoryId}}"> 
            <br>
            <input type="submit" value="Filter" class="btn btn-secondary">
         
         </form>
         <hr>
         <a href="{{route('product.list',[$slug])}}">Back</a>
        </div>
      <div class="col-md-10">
        <div class="row">
      <!--foreach products-->
      @foreach($products as $product)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="{{asset(Storage::url($product->image))}}" height="200" style="width: 100%">
            <div class="card-body">
                <p><b>{{$product->name}} </b></p>
              <p class="card-text">
              {{Str::limit($product->description,120)}}
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                 <a href="{{route('product.view',[$product->id])}}"> <button type="button" class="btn btn-sm btn-outline-success">View</button>
                 </a>
                  <button type="button" class="btn btn-sm btn-outline-primary">Add to cart</button>
                </div>
                <small class="text-muted">${{$product->price}}</small>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    <!--endforeach-->
      </div>
    </div>
</div>
</div>

      
  

@endsection
