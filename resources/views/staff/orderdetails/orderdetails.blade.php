<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$table->nameTable}}</title>
    <link rel="shortcut icon" href="{{asset('resources/images/login/logo.png')}}">
    <link rel="stylesheet" href="{{asset('resources/css/staff/orderdetails/orderdetails.css')}}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Link FontAwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body>
    <div class="all">
        <div class="header">    
            <a href="{{ url()->previous() }}" type="button" class="btn" style="color:blue" role="button"><i class="fas fa-arrow-alt-left fa-lg return" style="font-size: 180%"></i></a>
            <div id="clock"></div>
            <strong id="inf-staff">{{ auth()->guard('staffs')->user()->fullName }}</strong>
        </div>
        <div class="contents">
            <div class="selected">
                <h1>Món đã chọn</h1>
            </div>
            <div class="menus">
                <div class="categorys">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                          <a class="nav-link active" href="#">Thức ăn</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Nước uống</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Vé buffet</a>
                        </li>
                      </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('resources/js/master/clock.js')}}"></script>
</body>
</html>