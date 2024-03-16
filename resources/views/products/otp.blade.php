<html>
    <body>
        <form method="POST" action="/testroute">
    @csrf
    <button type="submit">Send OTP</button>
</form>

<form method="POST" action="{{route('products.process.checkout')}}">
    {{-- <input class="form-control" name="price" value="{{$code}}" type="hidden"> --}}

    <input type="text" name="otp" required>
    <button id="myButton">Verify OTP</button>
</form>
    </body>
</html>
{{-- {{$code}} --}}
