<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nhân viên</title>
        <link rel="shortcut icon" href="{{asset('resources/images/login/logo.png')}}">
        <link rel="stylesheet" href="{{asset('resources/css/staff/staff.css')}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Link Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div>
            <div class="areaHeader">
                <div id="clock"></div>
                <strong id="inf-staff">{{ auth()->guard('staffs')->user()->fullName }}</strong>
                <div id="btn-logout">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Đăng xuất</button>
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
            </div>
            <div class="areaTables">
                @foreach($getTables as $table)
                <a href="{{ route('staff.order',['id' => $table['id']]) }}" style="text-decoration:none;">
                    @if ($table->status == 'trống')
                        <p id="nameTable" style="color: #04ff00">{{ $table->nameTable }}</p>
                    @elseif($table->status == 'có khách')
                        <p id="nameTable" style="color: #ff0000">{{ $table->nameTable }}</p>
                    @endif
                    <img src="{{asset('resources/images/sell/table.png')}}" alt="table" height="100" width="150">
                </a>
                @endforeach
            </div>
        </div>

        <script src="{{asset('resources/js/master/clock.js')}}"></script>
    </body>
</html>