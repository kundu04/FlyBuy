@extends('layouts.app')
@section('content')
<div class="container">
@if($errors->any())
@foreach($errors->all() as $error)
<div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Qty</th>
        </tr>
    </thead>
    <tbody>
    @if($cart)
    @php $i=1 @endphp
    @foreach($cart->items as $product)
        <tr>
        <th scope="row">{{$i++}}</th>
        <td><img src="{{asset(Storage::url($product['image']))}}" alt="" width="100"></td>
        <td>{{$product['name']}}</td>
        <td>${{$product['price']}}</td>
        <td>
        <form action="{{route('cart.update',$product['id'])}}" method="post">@csrf
        <input type="text" name="qty" value="{{$product['qty']}}">
        <button class="btn btn-secondary btn-sm">
        <i class="fas fa-sync">Update</i>
        </button>
        </form>
        </td>
        <td>
        <button class="btn btn-danger">Remove</button>
        </td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <hr>
    <div class="cars-footer">
        <button class="btn btn-primary">Contineu Shopping</button>
        <span style="margin-left:300px;">${{$cart->totalPrice}}</span>
        <button class="btn btn-info float-right">Checkout</button>
    </div>
    @else
    <td>No items in cart</td>
    @endif
    
</div>
@endsection