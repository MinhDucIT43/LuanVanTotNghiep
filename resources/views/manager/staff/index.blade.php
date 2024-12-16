@extends('master')

@section('title')
    Admin - Staff
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">Nhân viên</h2>
        <span id="entireAddStaff">
            <button type="button" class="btn btn-primary functionNewAdd" data-bs-toggle="modal" data-bs-target="#addStaff">Thêm
                nhân viên</button>
            <div class="modal fade" id="addStaff" tabindex="-1" aria-labelledby="addStaffLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <strong>
                                <h3 class="modal-title" id="addStaffLabel">Thêm nhân viên</h3>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </div>
                </div>
            </div>
        </span>
        {{-- Table Staff --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Họ và Tên</th>
                    <th>Chức vụ</th>
                    <th>Số điện thoại</th>
                    <th>Hiện tại</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getStaffs as $staff)
                    <tr>
                        <td style="padding-left: 1em"></td>
                        <td>Ảnh nè</td>
                        <td>{{ $staff->fullName }}</td>
                        <td>{{ App\Models\positions::where('position_code', $staff['position_code'])->value('position_name') }}
                        </td>
                        <td>{{ $staff->phone }}</td>
                        <td>
                            @if ($staff->status == 1)
                                <i class="fas fa-circle fa-lg" style="color: #04ff00;"></i>
                            @else
                                <i class="fas fa-circle fa-lg" style="color: #ff0000;"></i>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-info seeMore" data-bs-toggle="modal" data-bs-target="#seeMore{{ $staff->staff_code }}">xem thêm</button>
                            <div class="modal fade" id="seeMore{{ $staff->staff_code }}" tabindex="-1"
                                aria-labelledby="seeMoreLabel{{ $staff->staff_code }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <strong>{{ $staff->fullName }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="seeMore"><strong>Giới tính:</strong> {{ $staff->sex }}</p>
                                            <p class="seeMore"><strong>Ngày sinh:</strong> {{ date('d/m/Y',strtotime($staff->birthday)) }}</p>
                                            <p class="seeMore"><strong>Địa chỉ:</strong> {{ $staff->address }}</p>
                                            <p class="seeMore"><strong>Ngày vào làm:</strong> {{ date('d/m/Y',strtotime($staff->workingDay)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span id="entireUpdateStaff">
                                <button type="button" class="btn updateStaff" data-bs-toggle="modal"
                                    data-bs-target="#updateStaff{{ $staff->staff_code }}"><i class="fas fa-tools fa-lg"
                                        style="color: #FFD43B; margin-right: 1em;"></i></button>
                                <div class="modal fade" id="updateStaff{{ $staff->staff_code }}" tabindex="-1"
                                    aria-labelledby="updateStaffLabel{{ $staff->staff_code }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <strong>
                                                    <h3 class="modal-title" id="updateStaffLabel{{ $staff->staff_code }}">
                                                        Sửa thông tin nhân viên
                                                    </h3>
                                                </strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Sửa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <span id="entireDeleteStaff">
                                <button type="button" class="btn deleteStaff" data-bs-toggle="modal"
                                    data-bs-target="#deleteStaff{{ $staff->staff_code }}"><i class="fas fa-times fa-lg"
                                        style="color: #ff0000;"></i></button>
                                <div class="modal fade" id="deleteStaff{{ $staff->staff_code }}" tabindex="-1"
                                    aria-labelledby="deleteStaffLabel{{ $staff->staff_code }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <strong>
                                                    <h3 class="modal-title" id="deleteStaffLabel{{ $staff->staff_code }}">
                                                        Xoá nhân viên
                                                    </h3>
                                                </strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Bạn có chắc chắn muốn xoá?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="#"><button type="button"
                                                        class="btn btn-danger">Xoá</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('nav-link-staffs')
    active
@endsection
