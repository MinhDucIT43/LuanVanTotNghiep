@extends('background.bgblack')

@section('content')
    <div class="login-form">
        <img src="resources/images/login/login.png" alt="Login" id="login-img">
        <a class="btn btn-primary m-1" href="{{ route('auth.getLogin') }}" role="button" id="return">Trở về</a>
        <h1 id="title-resetpassword">Đổi mật khẩu</h1>
        <p id="inputcode-note"><i>* Kiểm tra thiết bị của bạn, chúng tôi đã gửi mã xác thực.</i></p>
        <form method="post" action="{{ route('repass.postCode') }}"> @csrf
            <div class="form-group" id="top-form">
                <label>Mã xác thực</label>
                <input type="text" name="code" id="code" class="form-control" placeholder="Nhập mã xác thực" value="{{old('code')}}">
            </div>
            <button type="submit" class="btn btn-primary">Xác thực</button>
        </form>
        <div class="error-messages">
            @if($errors->has('code'))
            <span class="error-message"> * {{ $errors->first('code') }} </span>
            @endif
        </div>
    </div>
@endsection