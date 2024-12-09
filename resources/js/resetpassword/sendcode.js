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

window.onload = function(){
    render();
}

function render(){
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}

function sendCode(){
    const inputPhone = document.getElementById("phone").value.trim(); // Dùng trim() để loại bỏ khoảng trắng
  if (!inputPhone) {
    toastr.error('Vui lòng nhập số điện thoại.', 'Lỗi');
  } else {
    var phone = $('#phone').val();
    var updatedPhoneNumber = phone.replace(/^0/, "+84");
    firebase.auth().signInWithPhoneNumber(updatedPhoneNumber, window.recaptchaVerifier).then(function(confirmationResult){
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        toastr.success('Đã gửi mã xác thực tới số điện thoại vừa nhập.', 'Thành công');
    }).catch(function(error){
        toastr.error('Vui lòng kiểm tra lại số điện thoại.', 'Thất bại');
    });
  }
}

function verifyCode(){
    var code = $('#code').val();
    coderesult.confirm(code).then(function(result){
        var user = result.user;
    }).catch(function(error){
        console.log(error);
    });
}