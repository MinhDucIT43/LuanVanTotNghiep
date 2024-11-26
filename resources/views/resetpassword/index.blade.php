@extends('background.bgblack')

@section('content')
<div class="login-form">
    <img src="resources/images/login/login.png" alt="Login" id="login-img">
    <a class="btn btn-primary m-1" href="{{ route('auth.getLogin') }}" role="button" id="return">Trở về</a>
    <h1 id="title-resetpassword">Đổi mật khẩu</h1>
    <form method="post" action="{{ route('repass.postResetPassword') }}" id="form-inputcode"> @csrf
        <div class="form-group" id="top-form">
            <label>Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{old('phone')}}" autofocus>
            <br>
            <div id="recaptcha-container"></div><br>
        </div>
        {{-- <button type="button" onclick="sendCode()" class="btn btn-primary">Gửi</button> --}}
    </form>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>

    <button type="button" onclick="sendCode()" class="btn btn-primary">test</button>

    <div id="error" style="color:red; display:none;"></div>
    <div id="sentMessage" style="color:green; display:none;"></div>
    <div class="error-messages">
        @if($errors->has('phone'))
        <span class="error-message"> * {{ $errors->first('phone') }} </span>
        @endif
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyALcLnesaZWFNJwfPdzJgmP06dsP3054ZE",
        authDomain: "king-bbq-restaurant.firebaseapp.com",
        projectId: "king-bbq-restaurant",
        storageBucket: "king-bbq-restaurant.firebasestorage.app",
        messagingSenderId: "861263492936",
        appId: "1:861263492936:web:2fe1c4ceda761edc0c657d",
        measurementId: "G-929KKEM2JR"
    }
    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
    window.onload = function(){
        render();
    }

    function render(){
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    function sendCode(){
        console.log("send code");

        var phone = $('#phone').val();
        console.log(phone);
        console.log("send code2");

        firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier).then(function(confirmationResult){
            console.log(confirmationResult);
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult);
            $('#sentMessage').text("Message sent successfully!");
            $('#sentMessage').show();
        }).catch(function(error){
            console.log(error);
            $('#error').text(error.message);
            $('#error').show();
        });
    }
</script>
@endsection