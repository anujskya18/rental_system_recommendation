@extends('layouts.app')

@section('content')
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="margin-top:-25px;    background-color: #343a40 !important;;">
            {{-- background-image: url({{asset('assets/img/bg-header.jpg')}}) --}}
            <div class="container">
                <h1 class="pt-5">
                   {{$product->name}}
                </h1>
                <p class="lead">
                    {{$product->description}}
                </p>
            </div>
        </div>
    </div>
    <div class="container">

        @if (\Session::has('success'))
        <div class="bg-alert alert-success">
            
            <p>{!!\Session::get('success')!!}</p>
        </div>
        @endif
    </div>

    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="slider-zoom">
                        <a href="{{asset('assets/img/'. $product->image.'')}}" class="cloud-zoom" rel="transparentImage: 'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: false, zoomWidth:'500', zoomHeight:'500', adjustY:0, adjustX:10" id="cloudZoom">
                            <img alt="Detail Zoom thumbs image" src="{{asset('assets/img/'. $product->image.'')}}" style="width: 100%;">
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <p>
                        <strong>Overview</strong><br>
                        {{$product->description}}
                    </p>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                <strong>Price</strong><br>
                                <span class="price">Rs {{$product->price}} per day</span>
                                {{-- <div class="col-sm-6"><span class="pt-1 d-inline-block">per day</span></div> --}}
                                {{-- <span class="old-price">Rp 150.000</span> --}}
                            </p>
                        </div>   <div class="col-sm-6">
                            <p>
                                <strong>Rating</strong><br>
                                <div class="row container">
             
        
                                    <div id="rating_div">
                                        <div class="star-rating" style=" color: darkorange;" >
                                            <span class="fa divya fa-star{{ $product->rating>= 1 ? '' : '-o' }}" data-rating="1" ></span>
                                            <span class="fa divya fa-star{{ $product->rating>= 2 ? '' : '-o' }}" data-rating="2" ></span>
                                            <span class="fa divya fa-star{{ $product->rating>= 3 ? '' : '-o' }}" data-rating="3" ></span>
                                            <span class="fa divya fa-star{{ $product->rating>= 4 ? '' : '-o' }}" data-rating="4" ></span>
                                            <span class="fa divya fa-star{{ $product->rating>= 5 ? '' : '-o' }}" data-rating="5" ></span>
                                
                                        </div>
                                    </div>
                                    </div>
                            </p>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                <strong>Address</strong><br>
                                <span style="color: #E91E63;"> {{$product->address}}</span>
                                {{-- <div class="col-sm-6"><span class="pt-1 d-inline-block">per day</span></div> --}}
                                {{-- <span class="old-price">Rp 150.000</span> --}}
                            </p>
                        </div>
                       
                    </div>
                    
                    <div class="row" style="font-size: 20px;">
                        <form action="{{route('products.addcart')}}" method="post">
                        @csrf
                        <div class="col-sm-1.5 " style="float: left;">
                        <p class="mb-1">
                            Rent For
                        </p>
                        </div> 
                            <div class="col-sm-2 " style="float: left;">
                               
                            <input name="qty" class="form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="1" name="vertical-spin">
                        </div> 
                        <div class="col-sm-3 " style="float: left;padding-left: 0px; ">
                        <p class="mb-1">
                            Days                        </p>
                        </div>                       
                    </div>
                        <input name="name" value="{{$product->name}}" type="hidden">
                        <input name="price" value="{{$product->price}}" type="hidden">
                        <input name="pro_id" value="{{$product->id}}" type="hidden">

                        <input name="image" value="{{$product->image}}" type="hidden">
                        @if(isset(auth::user()->id))
                            @if ($checkInCart >0)
                                    <button disabled class="mt-3 btn btn-primary btn-lg">
                                        <i class="fa fa-shopping-basket"></i> Added to Cart
                                    </button>
                            @else 
                                <button type="submit" name="submit" class="mt-3 btn btn-primary btn-lg">
                                    <i class="fa fa-shopping-basket"></i> Add to Cart
                                    </button>
                            @endif
                        @else
                        <p class="alert alert-success mt-5"> Login to add product to cart </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="related-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">Related Products</h2> 
                    @include('products.index')
                  
                </div>
            </div>   

        </div>  
    </section>
</div>

@endsection