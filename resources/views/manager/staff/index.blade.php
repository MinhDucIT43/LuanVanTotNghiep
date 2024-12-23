@extends('master')

@section('title')
    Admin - Staff
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">Nhân viên</h2>
        <span id="entireAddStaff">
            <button type="button" id="btnFunctionNewAdd" class="btn btn-primary functionNewAdd" data-bs-toggle="modal"
                data-bs-target="#addStaff"> Thêm
                nhân viên</button>
            <div class="modal fade" id="addStaff" tabindex="-1" aria-labelledby="addStaffLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <strong>
                                <h3 class="modal-title" id="addStaffLabel">Thêm nhân viên</h3>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formAddStaff" method="post" action="{{ route('manager.addStaff') }}"> @csrf
                                <table>
                                    <div class="form-group" id="top-form">
                                        <tr>
                                            <td><strong><label for="fullName">Họ và tên:</label></strong></td>
                                            <td><input type="text" name="fullName" id="fullName" class="form-control"
                                                    placeholder="Nhập họ và tên" value="{{ old('fullName') }}" autofocus>
                                            </td>
                                            <td><strong><label for="imgOfStaff">Ảnh nhân viên:</label></strong></td>
                                            <td><input class="form-control" type="file" id="imgOfStaff" name="imgOfStaff" accept=".jpg,.png"></td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="birthday">Năm sinh:</label></strong></td>
                                            <td><input type="date" id="birthday" name="birthday"></td>
                                            <td><strong><label for="sex">Giới tính:</label></strong></td>
                                            <td>
                                                <input type="radio" name="sex" id="sex" value="Nam" checked="checked">Nam
                                                <input type="radio" name="sex" id="sex" value="Nữ">Nữ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="address">Địa chỉ:</label></strong></td>
                                            <td><textarea name="address" id="address" cols="21" rows="6" placeholder="Nhập địa chỉ nhân viên"></textarea></td>
                                            <td><strong><label for="workingDay">Ngày vào làm:</label></strong></td>
                                            <td><input type="date" id="workingDay" name="workingDay"></td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="phone">Số điện thoại:</label></strong></td>
                                            <td>
                                                <input type="text" name="phone" id="phone" class="form-control"
                                                    placeholder="Nhập số điện thoại" value="{{ old('phone') }}">
                                            </td>
                                            <td><strong><label for="position">Chức vụ:</label></strong></td>
                                            <td>
                                                <select name="position" id="optionPosition" class="form-select" aria-label="Default select example">
                                                    <option selected hidden>Chọn chức vụ</option>
                                                    {{-- Hiển thị dữ liệu thông qua Ajax --}}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="password">Mật khẩu:</label></strong></td>
                                            <td><input type="password" name="password" id="password" class="form-control"
                                                    placeholder="Nhập mật khẩu" value="{{ old('password') }}">
                                            </td>
                                        </tr>
                                    </div>
                                    {{-- <div class="form-group" id="top-form" style="display:none;">
                                        <strong><label for="status">Trạng thái:</label></strong>
                                        <input type="radio" name="status" id="status" value="1"
                                            checked="checked" />
                                        <input type="radio" name="status" id="status" value="0" />
                                    </div> --}}
                                </table>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <span id="entireContentTableStaff">
            {{-- Table Staff --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="specificContents">STT</th>
                        <th class="specificContents">Ảnh</th>
                        <th class="specificContents">Họ và Tên</th>
                        <th class="specificContents">Chức vụ</th>
                        <th class="specificContents">Số điện thoại</th>
                        <th class="specificContents">Hiện tại</th>
                        <th class="specificContents"></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getStaffs as $staff)
                        <tr>
                            <td class="specificContents" style="padding-left: 1em"></td>
                            <td class="specificContents"><img
                                    src="{{ asset('resources/images/manager/staffs/' . $staff->imgOfStaff) }}"
                                    alt="Ảnh nhân viên {{ $staff->fullName }}" width="100" height="100"></td>
                            <td class="specificContents">{{ $staff->fullName }}</td>
                            <td class="specificContents">
                                {{ App\Models\positions::where('position_code', $staff['position_code'])->value('position_name') }}
                            </td>
                            <td class="specificContents">{{ $staff->phone }}</td>
                            <td class="specificContents">
                                @if ($staff->status == 1)
                                    <i class="fas fa-circle fa-lg" style="color: #04ff00;"></i>
                                @else
                                    <i class="fas fa-circle fa-lg" style="color: #ff0000;"></i>
                                @endif
                            </td>
                            <td class="specificContents">
                                <button type="button" class="btn btn-info seeMore" data-bs-toggle="modal"
                                    data-bs-target="#seeMore{{ $staff->staff_code }}">xem thêm</button>
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
                                                <p class="seeMore"><strong>Ngày sinh:</strong>
                                                    {{ date('d/m/Y', strtotime($staff->birthday)) }}</p>
                                                <p class="seeMore"><strong>Địa chỉ:</strong> {{ $staff->address }}</p>
                                                <p class="seeMore"><strong>Ngày vào làm:</strong>
                                                    {{ date('d/m/Y', strtotime($staff->workingDay)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="specificContents">
                                <span id="entireUpdateStaff">
                                    <button type="button" class="btn updateStaff specificContents"
                                        data-bs-toggle="modal" data-bs-target="#updateStaff{{ $staff->staff_code }}"><i
                                            class="fas fa-tools fa-lg"
                                            style="color: #FFD43B; margin-right: 1em;"></i></button>
                                    <div class="modal fade" id="updateStaff{{ $staff->staff_code }}" tabindex="-1"
                                        aria-labelledby="updateStaffLabel{{ $staff->staff_code }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <strong>
                                                        <h3 class="modal-title"
                                                            id="updateStaffLabel{{ $staff->staff_code }}">
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
                                    <button type="button" class="btn deleteStaff specificContents"
                                        data-bs-toggle="modal" data-bs-target="#deleteStaff{{ $staff->staff_code }}"><i
                                            class="fas fa-times fa-lg" style="color: #ff0000;"></i></button>
                                    <div class="modal fade" id="deleteStaff{{ $staff->staff_code }}" tabindex="-1"
                                        aria-labelledby="deleteStaffLabel{{ $staff->staff_code }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <strong>
                                                        <h3 class="modal-title"
                                                            id="deleteStaffLabel{{ $staff->staff_code }}">
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
        </span>
    </div>

    <script>
        const userStoreUrl = "{{ route('manager.addStaff.getOptionPosition') }}";
        $(document).ready(function() {
            $('#btnFunctionNewAdd').click(function() {
                $.ajax({
                    url: userStoreUrl, // URL đến route Laravel
                    method: 'GET',
                    success: function(positions) {
                        positions.forEach(function(position) {
                            $('#optionPosition').append(`
                                <option value="${position.position_code}">${position.position_name}</option>
                            `);
                        });
                    },
                    error: function(err) {
                        console.error(err);
                    }
                });
            });
        });
    </script>
@endsection

@section('nav-link-staffs')
    active
@endsection
