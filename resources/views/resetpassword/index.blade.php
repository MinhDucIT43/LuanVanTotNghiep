@extends('background.bgblack')

@section('content')
<div id="return">
    <a class="btn btn-primary m-1" href="{{ route('auth.getLogin') }}" role="button">Trở về</a>
</div>
<div class="login-form">
    <h1 id="title-resetpassword">Đổi mật khẩu</h1>
    <form method="post" action="{{ route('repass.postResetPassword') }}" id="form-inputcode"> @csrf
        <div class="form-group" id="top-form">
            <label>Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{old('phone')}}" autofocus>
            <br>
            <div id="recaptcha-container"></div><br>
        </div>
        <button class="btn btn-primary" type="button" onclick="sendCode()" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Gửi
        </button>
    </form>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="post" action="{{ route('repass.postCode') }}"> @csrf
                <div class="form-group" id="top-form">
                    <label>Mã xác thực</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Nhập mã xác thực" value="{{old('code')}}">
                </div>
                <button type="button" onclick="verifyCode()" class="btn btn-primary">Xác thực</button>
            </form>
        </div>
    </div>
    <div id="sucessMessage" style="color:green; display:none;"></div>
    <div id="error" style="color:red; display:none;"></div>
    <div id="sentMessage" style="color:green; display:none;"></div>
    <div class="error-messages">
        @if($errors->has('phone'))
        <span class="error-message"> * {{ $errors->first('phone') }} </span>
        @endif
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script src="resources/js/resetpassword/sendcode.js"></script>
@endsection