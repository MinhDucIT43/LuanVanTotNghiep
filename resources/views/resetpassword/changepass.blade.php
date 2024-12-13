@extends('background.bgblack')

@section('content')
<div class="login-form">
    <img src="resources/images/login/login.png" alt="Login" id="login-img">
    <div style="position:relative; float:right; bottom:2.8em; left:12.2em;">
        <a class="btn btn-success m-1" href="{{ route('repass.inputPhoneNumberAndReceiveCode') }}" role="button">Trở về</a>
    </div>
    <h1 id="title-resetpassword" style="color: blue; text-align: center; position: relative; top: 10px;">Đổi mật khẩu</h1>
    <form method="POST" action="{{ route('repass.postChangePass') }}" id="form-inputpass"> @csrf
        <div class="form-group">
            <label for="passWordOld">Mật khẩu cũ</label>
            <input type="password" name="passWordOld" id="passWordOld" class="form-control" placeholder="Nhập mật khẩu cũ" value="{{old('passWordOld')}}">
        </div>
        <div class="form-group">
            <label for="passWordNew">Mật khẩu mới</label>
            <input type="password" name="passWordNew" id="passWordNew" class="form-control" placeholder="Nhập mật khẩu mới" value="{{old('passWordNew')}}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    <div class="error-messages">
        @if($errors->has('passWordOld'))
        <span class="error-message"> * {{ $errors->first('passWordOld') }} </span>
        @endif
        <br />
        @if($errors->has('passWordNew'))
        <span class="error-message"> * {{ $errors->first('passWordNew') }} </span>
        @endif
    </div>
</div>
@endsection