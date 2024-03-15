@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="container">
            @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{!!\Session::get('success')!!}</p>
            </div>
            @endif
          </div>
          <h5 class="card-title mb-4 d-inline">Products</h5>
          <a  href="{{route('products.create')}}" class="btn btn-primary mb-4 text-center float-right">Create Products</a>
        
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">product</th>
                <th scope="col">price in $$</th>
                {{-- <th scope="col">Description</th> --}}
                <th scope="col">rating</th>
                <th scope="col">delete</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($allProducts as $products)
                <tr>
                    <th scope="row">{{$products->id}}</th>
                    <td>{{$products->name}}</td>
                    <td>Rs {{$products->price}}</td>
                    {{-- <td>Rs {{$products->description}}</td> --}}
                    <td>
                        <div class="row container">
             
        
                            <div id="rating_div">
                                <div class="star-rating" style=" color: darkorange;" >
                                    <span class="fa divya fa-star{{ $products->rating>= 1 ? '' : '-o' }}" data-rating="1" ></span>
                                    <span class="fa divya fa-star{{ $products->rating>= 2 ? '' : '-o' }}" data-rating="2" ></span>
                                    <span class="fa divya fa-star{{ $products->rating>= 3 ? '' : '-o' }}" data-rating="3" ></span>
                                    <span class="fa divya fa-star{{ $products->rating>= 4 ? '' : '-o' }}" data-rating="4" ></span>
                                    <span class="fa divya fa-star{{ $products->rating>= 5 ? '' : '-o' }}" data-rating="5" ></span>
                        
                                </div>
                            </div>
                            </div>
                        
                    </td>

                    
                     <td><a href="{{route('products.delete',$products->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>  
                @endforeach
             
            </tbody>
          </table> 
          
        </div>
      </div>
    </div>
  </div>


 





@endsection