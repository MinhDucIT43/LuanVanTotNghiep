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
                    @if($table->status == 'trống')
                        <a href="#" style="text-decoration:none;" data-bs-toggle="modal" data-bs-target="#handleAvailable">
                            <p id="nameTable" style="color: #04ff00">{{ $table->nameTable }}</p>
                            <img src="{{asset('resources/images/sell/table.png')}}" alt="table" height="100" width="150">
                        </a>
                        <div class="modal fade" id="handleAvailable" tabindex="-1" aria-labelledby="examplehandleAvailableLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="examplehandleAvailableLabel">Chọn giá vé Buffet</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formSelectTicketPrice" method="post" action="{{ route('staff.selectTable.selectTicketPrice', $table->id) }}">@csrf
                                            <div class="form-group" id="top-form">
                                                <select name="ticketPrice" id="ticketPrice" class="form-select" aria-label="Default select example">
                                                    <option selected hidden value="">Chọn giá vé</option>
                                                    @foreach(App\Models\tickets::all() as $ticket)
                                                        <option value="{{$ticket->id}}">{{$ticket->nameTicket}}: {{$ticket->price}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="container mt-3">
                                                <strong><label for="quantity" class="form-label">Số lượng:</label></strong>
                                                <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Chọn</button>
                                            </div>
                                        </form>
                                    <div class="error-messages">
                                        @if($errors->has('ticketPrice'))
                                            <span class="error-message"> * {{ $errors->first('ticketPrice') }} </span>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('staff.selectTable',['id' => $table['id']]) }}" style="text-decoration:none;">
                            @if($table->status == 'có khách')
                                <p id="nameTable" style="color: #F44336">{{ $table->nameTable }}</p>
                            @elseif($table->status == 'chờ thanh toán')
                                <p id="nameTable" style="color: #FF9800">{{ $table->nameTable }}</p>
                            @elseif($table->status == 'đặt trước')
                                <p id="nameTable" style="color: #FFC107">{{ $table->nameTable }}</p>
                            @elseif($table->status == 'bảo trì')
                                <p id="nameTable" style="color: #9E9E9E">{{ $table->nameTable }}</p>
                            @endif
                            <img src="{{asset('resources/images/sell/table.png')}}" alt="table" height="100" width="150">
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        <script src="{{asset('resources/js/master/clock.js')}}"></script>
        @if($errors->any())
            <script src="{{ asset('resources/js/selectticket/addticket.js') }}"></script>
        @endif
        <script src="{{ asset('resources/js/master/reloadafterclosemodal.js') }}"></script>
    </body>
</html>