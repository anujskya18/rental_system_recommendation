@extends('layouts.app')

@section('content')

<div id="page-content" class="page-content">
    <div class="banner">
                <div class="jumbotron jumbotron-bg text-center rounded-0" style="margin-top:-25px;    background-color: #343a40 !important;">

            <div class="container">
                <h1 class="pt-5">
                    Your Transactions
                </h1>
                <p class="lead">
                    Save time and leave the groceries to us.
                </p>
            </div>
        </div>
    </div>

    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%"></th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($orders->count()>0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>
                                                {{$order->name}}
                                            </td>
                                            <td>
                                                {{$order->address}}
                                            </td>
                                            <td>
                                                {{$order->phone_number}}
                                            </td>
                                            <td>
                                                {{$order->email}}
                                            </td>
                                            <td>
                                                {{$order->status}}
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                    <p class="alert alert-danger">No orders yet !</p>   
                                    </tr>
                                @endif    
                            </tbody>
                        </table>
                    </div>

                  
                </div>
            </div>
        </div>
    </section>

   
</div>
@endsection