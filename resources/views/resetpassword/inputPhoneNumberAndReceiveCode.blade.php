@extends('background.bgblack')

@section('nameTitle')
    - Đổi mật khẩu
@endsection

@section('whereToStoreCSSFiles')
resetpassword/resetpassword.css
@endsection

@section('content')
<div id="return">
    <a class="btn btn-success m-1" href="{{ url()->previous() }}" role="button">Trở về</a>
</div>
<div class="login-form">
    <h1 id="title-resetpassword">Đổi mật khẩu</h1>
    <form id="formSubmitPhoneNumber"> @csrf
        <div class="form-group" id="top-form">
            <label>Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{old('phone')}}" form="formSubmitCode" autofocus>
            <br>
            <div id="recaptcha-container"></div><br>
        </div>
        <button class="btn btn-primary" type="button" onclick="sendCode()" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Gửi</button>
    </form>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form id="formSubmitCode" method="post" action="{{ route('repass.verify') }}"> @csrf
                <div class="form-group" id="top-form">
                    <label>Mã xác thực</label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Nhập mã xác thực" value="{{old('code')}}">
                </div>
                <button type="submit" onclick="verifyCode()" class="btn btn-primary">Xác thực</button>
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

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection