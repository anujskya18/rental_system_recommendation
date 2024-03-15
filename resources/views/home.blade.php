@extends('layouts.app')

@section('content')

<div id="page-content" class="page-content" style="margin-top:-25px">
        <div class="banner">
            <div class="jumbotron jumbotron-video text-center bg-dark mb-0 rounded-0 rounded-bottom" style="
            width: 99%;
            margin: auto;
            /* margin-top: 84px; */
        ">
                {{-- <img src="{{ asset('assets/img/background.jpg')}}" alt=""> --}}
                {{-- <video width="100%" preload="auto" loop autoplay muted>
                    <source src='assets/media/explore.mp4' type='video/mp4' />
                    <source src='assets/media/explore.webm' type='video/webm' />
                </video> --}}
                <div class="container">
                    <h1 class="pt-5">
                       Rent<br>
                       Use<br>
                       Return<br>
                    </h1>
                    {{-- <p class="lead">
                        Always Fresh Everyday.
                    </p> --}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fa fa-shopping-basket"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Rent
                                    </h4>
                                    {{-- <p class="card-text">
                                        Simply click-to-buy on the product you want and submit your order when you're done.
                                    </p> --}}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fa     fa-handshake"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Use
                                    </h4>
                                    {{-- <p class="card-text">
                                        Our team ensures the produce quality is up to our standard and delivers to your door within 24 hours of harvest day.
                                    </p> --}}

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        Return
                                    </h4>
                                    {{-- <p class="card-text">
                                        Farmers receive your orders two days in advance so they can prepare for harvest exactly as your orders – no wasted produce.
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section id="why">
            <h2 class="title">Rental System</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-6    ">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                    <i class="fa fa-leaf"></i>                              
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    Resources are hired to give results, not reasons.
                                </h4>
                                <p class="card-text">
                                    Encourageing individuals by renting items to prioritize the outcomes and benefits they seek to achieve through the rental process
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                    <i class="fa fa-recycle"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                    Rent smart, reuse often.
                                </h4>
                                <p class="card-text">
                                    By reusing items instead of discarding them after a single use, can minimize environmental impact, reduce costs associated with frequent replacements, and contribute to a more sustainable business model.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5 text-center">
                        <a href="{{route('products.shop')}}" class="btn btn-primary btn-lg">SHOP NOW</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="categories" class="pb-0 gray-bg">
            <h2 class="title">Categories</h2>
            <div class="landing-categories owl-carousel">
                @foreach ($categories as $category)
                    <div class="item">
                        <div class="card rounded-0 border-0 text-center">
                            <img src="{{ asset('assets/img/'.$category->image.'')}}">
                            <div class="card-img-overlay d-flex align-items-center justify-content-center">
                                <!-- <h4 class="card-title">Electronics</h4> -->
                                <a href="{{route('single.category',$category->id)}}" class="btn btn-primary btn-lg">{{$category->name}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                
            </div>
        </section>  
    </div>
@endsection
