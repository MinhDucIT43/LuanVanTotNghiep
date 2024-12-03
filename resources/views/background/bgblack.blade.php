<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buffet King BBQ</title>
    
    <link rel="shortcut icon" href="resources/images/login/logo.png">
    <link rel="stylesheet" href="resources/css/login/login.css">
    <link rel="stylesheet" href="resources/css/resetpassword/resetpassword.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Link Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Link Fontawesome-icon -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body class="antialiased">
    <div class="sidenav">
        <div class="login-main-text">
            <i class="fas fa-utensils"></i>
            <h2>Nhà hàng Buffet</h2>
            <p>King BBQ</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            @yield('content')
        </div>
    </div>
</body>
</html>