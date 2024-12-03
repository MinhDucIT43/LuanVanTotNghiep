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
    var phone = $('#phone').val();
    var updatedPhoneNumber = phone.replace(/^0/, "+84");

    firebase.auth().signInWithPhoneNumber(updatedPhoneNumber, window.recaptchaVerifier).then(function(confirmationResult){
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        $('#sentMessage').text("Message sent successfully!");
        $('#sentMessage').show();
    }).catch(function(error){
        $('#error').text(error.message);
        $('#error').show();
    });
}

function verifyCode(){
    var code = $('#code').val();
    console.log(code);
    coderesult.confirm(code).then(function(result){
        var user = result.user;
        $('#sucessMessage').text("Verify code successfully!");
        $('#sucessMessage').show();
    }).catch(function(error){
        console.log(error);
        $('#error').text(error.message);
        $('#error').show();
    });
}