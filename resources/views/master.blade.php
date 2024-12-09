<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{asset('resources/images/login/logo.png')}}">
    <link rel="stylesheet" href="{{asset('resources/css/master.css')}}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="btn-logout">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-power-off"></i></button>
            </div>
            <div id="clock"></div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn đăng xuất?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <a href="{{route('auth.logout')}}"><button type="button" class="btn btn-danger">Đăng xuất</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu">
            <div id="inf-admin" style="text-align:center">
                <a id="link-home" href="{{ route('manager.index') }}">
                    <img src="{{asset('resources/images/manager/logo-admin.png')}}" id="logo-admin" alt="Logo Admin">
                    <i class="fas fa-circle fa-lg" style="color: #1eff00;"></i>
                    <br/>
                    <strong style="color: black">{{ auth()->guard('staffs')->user()->fullName }}</strong>
                </a>
            </div>
            <div class="list-group">
                <a href="{{ route('manager.position') }}" class="list-group-item list-group-item-action @yield('nav-link-position')"><i class="fas fa-address-book" style="color: #000205;"></i> Quản lý chức vụ</a>
                <a href="#" class="list-group-item list-group-item-action @yield('nav-link-a')">A third link item</a>
                <a href="#" class="list-group-item list-group-item-action @yield('nav-link-b')">A fourth link item</a>
                <a href="#" class="list-group-item list-group-item-action @yield('nav-link-c')">A disabled link item</a>
            </div>
        </div>
        <div id="content">
            @yield('content-manager')
        </div>
    </div>
    <!-- Script tạo đồng hồ -->
    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').textContent = timeString;
        }
        // Cập nhật đồng hồ mỗi giây
        setInterval(updateClock, 1000);
        // Hiển thị thời gian ngay lập tức khi tải trang
        updateClock();

        // Cột STT:
        const rows = document.querySelectorAll(".table tbody tr");
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });
    </script>
</body>

</html>