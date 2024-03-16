<html>
    <body>

    <button type="submit" id="otpButton">Send OTP</button>
    <span id="loading" style="display:none">loading</span>
    <span id="success"></span></br>
    <input type="text" name="otp" class="otptext" required>
    <button id="otpVerify">Verify OTP</button>
    </br>
    <span id="valid"></span>

    <a style="display:none" id="continue" href="/products/cart">
        <button>Continue</button>
      </a>
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

function setCookie(name, value, daysToLive) {
    let cookie = name + "=" + encodeURIComponent(value);
    if (typeof daysToLive === "number") {
        cookie += "; max-age=" + (daysToLive * 24 * 60 * 60);
    }
    document.cookie = cookie;
}

function getCookie(name) {
    let cookieArr = document.cookie.split(";");
    for (let i = 0; i < cookieArr.length; i++) {
        let cookiePair = cookieArr[i].split("=");
        if (name === cookiePair[0].trim()) {
            return decodeURIComponent(cookiePair[1]);
        }
    }
    return null;
}

document.getElementById('otpButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    $.ajax({
    url: '/testroute',
    method: 'GET',
    beforeSend: function() {
        setCookie('ordervalidated',0,1)
        $('#loading').show();
    },
    success: function(response) {
        if (response.success) {
            console.log('Request successful',response.success);
            $('#loading').hide();
            document.querySelector('#success').innerHTML = "Sent";
            setCookie('otpcode',response.code,1)
            
        } else {
            console.log('Request failed');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('An error occurred:', errorThrown);
    }
});

});
document.getElementById('otpVerify').addEventListener('click', function(event) {

    document.querySelector('#valid').innerHTML = "";
    var otpcode = getCookie('otpcode');
    if (document.querySelector('.otptext').value == otpcode){
        document.querySelector('#valid').innerHTML = "Valid";
        $('#continue').show();
        setCookie('ordervalidated',1,1)

    }else{
        document.querySelector('#valid').innerHTML = "InValid";
    }

});
</script>
    </body>
</html>
{{-- {{$code}} --}}
