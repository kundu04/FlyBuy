@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="row">
            <aside class="col-sm-5 border-right">
                <section class="gallery-wrap">
                    <div class="img-big-wrap">
                        <a href="#"><img src="{{asset(Storage::url($product->image))}}" alt="" width=350></a>
                    </div>
                </section>

            </aside>
            <aside class="col-sm-7">
                <section class="card-body p-5">
                    <h3 class="title mb-3">{{$product->name}}</h3>
                    <p class="price-detail-wrap">
                        <span class="price h3 text-danger">
                            <span class="currency">${{$product->price}}</span>
                        </span>
                    </p>
                    <h3>Description</h3>
                    <p>{!! $product->description !!}</p>
                    <h3>Additional Information</h3>
                    <p>{!! $product->additional_info !!}</p>
                    <!-- <hr>
                    <div class="row">
                        <div class="form-inline">
                            <h3>Quantity</h3>
                            <input type="text" name="quantity" class="form-control">
                            <input type="submit" name="quantity" class="btn btn-primary ml-2">

                        </div>
                    </div> -->
                    <hr>
                    <a href="" class="btn btn-lg btn-outline-primary text-uppercase">Add to card</a>
                </section>

            </aside>
        </div>
    </div>

    <div class="jumbotron">
    <h3>YOU MAY ALSO LIKE</h3>
    <div class="row">
            @foreach($productFromSameCategory as $products)
                <div class="col-4">
                <div class="card shadow-sm">
                <img src="{{asset(Storage::url($products->image))}}" class="bd-placeholder-img card-img-top" width="100%" height="225">
                  
                <div class="card-body">
                    <p><b>{{$products->name}}</b></p>
                  <p class="card-text">{{(Str::limit($products->description,120))}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="{{route('product.view',[$products->id])}}"><button type="button" class="btn btn-sm btn-outline-primary">View</button></a>
                      <button type="button" class="btn btn-sm btn-outline-success">Add to card</button>
                    </div>
                    <small class="text-muted">${{$products->price}}</small>
                  </div>
                </div>
              </div>
                </div>
              @endforeach
                
            </div>
    </div>
</div>
@endsection
