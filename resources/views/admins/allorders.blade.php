@extends('layouts.admin')

@section('content')



<div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Orders</h5>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">User ID</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">address</th>
                <th scope="col">phone</th>
                <th scope="col">price</th>
                <th scope="col">order_notes</th>
                <th scope="col">status</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($allOrders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->user_id}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone_number}}</td>
                    <td>Rs. {{$order->price}}</td>
                    <td>{{$order->order_notes}}</td>
                    <td>{{$order->status}}</td>
                    <td>                
                        {{-- <a href="#" class="btn btn-warning text-white mb-4 text-center">update</a> --}}
                    </td>
                   
                  </tr>
                @endforeach
             
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>
@endsection