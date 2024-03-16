@extends('layouts.app')

@section('content')

<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="margin-top:-25px;background-color: #343a40 !important;');">
            <div class="container">
                <h1 class="pt-5">
                    Your Cart
                </h1>
                <p class="lead">
                    Save time and leave the groceries to us.
                </p>
            </div>
        </div>
    </div>

    <div class="container mt-5" >

        @if (\Session::has('delete'))
        <div class="bg-alert alert-success">
            
            <p>{!!\Session::get('delete')!!}</p>
        </div>
        @endif
    </div>
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="10%"></th>
                                    <th>Products</th>
                                    <th>Price</th>
                                    <th width="15%">Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartProducts as $product)
                                <tr>
                                    <td>
                                        <img src="{{asset('assets/img/'.$product->image.'')}}" width="60">
                                    </td>
                                    <td>
                                        {{$product->name}}<br>
                                        {{-- <small>1000g</small> --}}
                                    </td>
                                    <td>

                         Rs {{$product->price}}
                                    </td>
                                    <td>
                         <form action="{{route('products.updatecart')}}" method="post">
                        @csrf
                        <div class="col-sm-5 " style="padding: 1px;float: left;margin-right: 8px;">
                            <input name="qty" class="form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="{{$product->qty}}" name="vertical-spin">
                        </div>
                        <button type="submit" name="submit" class=" btn btn-primary btn-sm" style="
                        margin-top: 4px;
                    ">Update
                            </button>
                        <input name="id" value="{{$product->id}}" type="hidden">
                        </form> 
                                                                   
                                    </td>
                                    <td>
                                        Rs {{ $product->price * $product->qty}}
                                    </td>
                                    <td>
                                        <a href="{{route('products.cart.delete',$product->id)}}d" class="text-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col">
                    <a href="{{route('products.shop')}}" class="btn btn-default">Continue Shopping</a>
                </div>
                <div class="col text-right">
               
                    <div class="clearfix"></div>
                    <h6 class="mt-3">Total: Rs {{$subtotal}}</h6>
                    @if ($subtotal > 0)
                    @csrf
                    @if(!isset($_COOKIE["ordervalidated"]) || $_COOKIE["ordervalidated"] == 0) 
                    <form action="{{route('products.verify.otp')}}" method="post">
                        @csrf
                        
                        <input type="hidden" name="price" value="{{$subtotal}}">
                            <button type="submit" href="checkout.html" class="btn btn-lg btn-primary">Verify OTP <i class="fa fa-long-arrow-right"></i></button>
                    </form>
                        @else
                         <form action="{{route('products.checkout')}}">
                        @csrf

                            <button type="submit" href="checkout.html" class="btn btn-lg btn-primary">Checkout<i class="fa fa-long-arrow-right"></i></button>
                         </form>
                        @endif
                    @else
                    <p class="alert alert-success"> You have no products in cart you cant checkout</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

@endsection