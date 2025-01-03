@extends('master')

@section('title')
    Admin - Staff
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">Nhân viên</h2>
        <span id="entireAddStaff">
            <button type="button" id="btnFunctionNewAdd" class="btn btn-primary functionNewAdd" data-bs-toggle="modal" data-bs-target="#addStaff"> Thêm nhân viên</button>
            <div class="modal fade" id="addStaff" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addStaffLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header"><strong><h3 class="modal-title" id="addStaffLabel">Thêm nhân viên</h3></strong></div>
                        <div class="modal-body">
                            <form id="formAddStaff" method="post" action="{{ route('manager.addStaff') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="formType" name="formType" value="addStaffType">
                                <table>
                                    <div class="form-group" id="top-form">
                                        <tr>
                                            <td><strong><label for="fullName">Họ và tên:</label></strong></td>
                                            <td><input type="text" name="fullName" id="fullName" class="form-control" placeholder="Nhập họ và tên" value="{{ old('fullName') }}" autofocus></td>
                                            <td><strong><label for="imgOfStaff">Ảnh nhân viên:</label></strong></td>
                                            <td>
                                                <input class="form-control" type="file" id="imgOfStaff" name="imgOfStaff">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="birthday">Năm sinh:</label></strong></td>
                                            <td><input type="date" id="birthday" name="birthday" value="{{ old('birthday') }}"></td>
                                            <td><strong><label for="sex">Giới tính:</label></strong></td>
                                            <td>
                                                <input type="radio" name="sex" id="sexMale" value="Nam" checked="checked" {{ old('sex') == 'Nam' ? 'checked' : '' }}>Nam
                                                <input type="radio" name="sex" id="sexfemale" value="Nữ" {{ old('sex') == 'Nữ' ? 'checked' : '' }}>Nữ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="address">Địa chỉ:</label></strong></td>
                                            <td><textarea name="address" id="address" cols="21" rows="6" placeholder="Nhập địa chỉ nhân viên">{{ old('address') }}</textarea></td>
                                            <td><strong><label for="workingDay">Ngày vào làm:</label></strong></td>
                                            <td><input type="date" id="workingDay" name="workingDay" value="{{ old('workingDay') }}"></td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="phone">Số điện thoại:</label></strong></td>
                                            <td><input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{ old('phone') }}"></td>
                                            <td><strong><label for="position">Chức vụ:</label></strong></td>
                                            <td>
                                                <select name="position" id="position" class="form-select" aria-label="Default select example">
                                                    <option selected hidden value="">Chọn chức vụ</option>
                                                    @foreach(App\Models\positions::all() as $position)
                                                        <option value="{{$position->position_code}}" @if(old('position') == $position->position_code) ? selected @endif>{{$position->position_name}}</option>
                                                    @endforeach 
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong><label for="password">Mật khẩu:</label></strong></td>
                                            <td><input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" value="{{ old('password') }}"></td>
                                        </tr>
                                    </div>
                                </table>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="formAddStaff" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                            @if(old('formType') === 'addStaffType' && $errors->any())
                                <div class="error-messages">
                                    @if($errors->has('fullName'))
                                        <span class="error-message"> * {{ $errors->first('fullName') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('imgOfStaff'))
                                        <span class="error-message"> * {{ $errors->first('imgOfStaff') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('birthday'))
                                        <span class="error-message"> * {{ $errors->first('birthday') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('address'))
                                        <span class="error-message"> * {{ $errors->first('address') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('workingDay'))
                                        <span class="error-message"> * {{ $errors->first('workingDay') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('phone'))
                                        <span class="error-message"> * {{ $errors->first('phone') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('position'))
                                        <span class="error-message"> * {{ $errors->first('position') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('password'))
                                        <span class="error-message"> * {{ $errors->first('password') }} </span>
                                    @endif
                                </div>
                            @endif
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
                            <td class="specificContents">
                                <img id="imgOfStaff" src="{{ asset('resources/images/manager/staffs/' . $staff->imgOfStaff) }}" alt="Ảnh nhân viên {{ $staff->fullName }}" width="100" height="100">
                            </td>
                            <td class="specificContents">{{ $staff->fullName }}</td>
                            <td class="specificContents">{{ App\Models\positions::where('position_code', $staff['position_code'])->value('position_name') }}</td>
                            <td class="specificContents">{{ $staff->phone }}</td>
                            <td class="specificContents">
                                @if ($staff->status == 1)
                                    <i class="fas fa-circle fa-lg" style="color: #04ff00;"></i>
                                @else
                                    <i class="fas fa-circle fa-lg" style="color: #ff0000;"></i>
                                @endif
                            </td>
                            <td class="specificContents">
                                <button type="button" class="btn btn-info seeMore" data-bs-toggle="modal" data-bs-target="#seeMore{{$staff->staff_code}}">xem thêm</button>
                                <div class="modal fade" id="seeMore{{$staff->staff_code}}" tabindex="-1" aria-labelledby="seeMoreLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <strong>{{ $staff->fullName }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="seeMore"><strong>Giới tính:</strong> {{ $staff->sex }}</p>
                                                <p class="seeMore"><strong>Ngày sinh:</strong>{{ date('d/m/Y', strtotime($staff->birthday)) }}</p>
                                                <p class="seeMore"><strong>Địa chỉ:</strong> {{ $staff->address }}</p>
                                                <p class="seeMore"><strong>Ngày vào làm:</strong>{{ date('d/m/Y', strtotime($staff->workingDay)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span id="entireUpdateStaff">
                                    <button type="button" id="btnFunctionUpdateStaff" class="btn updateStaff btnFunction" data-bs-toggle="modal" data-bs-target="#updateStaff{{ $staff->staff_code }}">
                                        <i class="fas fa-tools fa-lg" style="color: #FFD43B; margin-right: 1em;"></i>
                                    </button>
                                    <div class="modal fade" id="updateStaff{{ $staff->staff_code }}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateStaffLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <strong><h3 class="modal-title" id="updateStaffLabel{{$staff->staff_code}}">{{old('imgOldOfStaff')}}Sửa thông tin nhân viên {{old('fullName',$staff->fullName)}}</h3></strong>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formUpdateStaff" method="post" action="{{ route('manager.updateStaff', $staff->staff_code) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="formType" name="formType" value="updateStaffType">
                                                        <table>
                                                            <div class="form-group" id="top-form">
                                                                <tr>
                                                                    <td><strong><label for="fullName">Họ và tên:</label></strong></td>
                                                                    <td><input type="text" name="fullName" id="fullName" class="form-control" placeholder="Nhập họ và tên" value="{{ old('fullName', $staff->fullName) }}" autofocus></td>
                                                                    <td><strong><label for="imgOfStaff">Ảnh nhân viên:</label></strong></td>
                                                                    <td>
                                                                        <input type="hidden" id="imgOldOfStaff" name="imgOldOfStaff" value="{{$staff->imgOfStaff}}" />
                                                                        <input class="form-control" type="file" id="imgOfStaff" name="imgOfStaff">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong><label for="birthday">Năm sinh:</label></strong>(mm/dd/yyyy)</td>
                                                                    <td><input type="date" id="birthday" name="birthday" value="{{ old('birthday', $staff->birthday) }}"></td>
                                                                    <td><strong><label for="sex">Giới tính:</label></strong></td>
                                                                    <td>
                                                                        <input type="radio" name="sex" id="sexMale" value="Nam" @if($staff->sex == 'Nam' or old('sex') == 'Nam') ? checked='checked' @endif>Nam
                                                                        <input type="radio" name="sex" id="sexFemale" value="Nữ" @if($staff->sex == 'Nữ' or old('sex') == 'Nữ') ? checked='checked' @endif>Nữ
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong><label for="address">Địa chỉ:</label></strong></td>
                                                                    <td><textarea name="address" id="address" cols="21" rows="6" placeholder="Nhập địa chỉ nhân viên">{{ old('address', $staff->address) }}</textarea></td>
                                                                    <td><strong><label for="workingDay">Ngày vào làm:</label></strong>(mm/dd/yyyy)</td>
                                                                    <td><input type="date" id="workingDay" name="workingDay" value="{{ old('workingDay', $staff->workingDay) }}"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong><label for="phone">Số điện thoại:</label></strong></td>
                                                                    <td><input type="text" name="phone" id="phone" class="form-control" placeholder="Nhập số điện thoại" value="{{ old('phone', $staff->phone) }}"></td>
                                                                    <td><strong><label for="position">Chức vụ:</label></strong></td>
                                                                    <td>
                                                                        <select name="position" id="position" class="form-select" aria-label="Default select example">
                                                                            <option selected hidden value="">Chọn chức vụ</option>
                                                                            @foreach(App\Models\positions::all() as $position)
                                                                                @foreach(App\Models\positions::where('position_code',$staff->position_code)->get() as $positionOfStaff)
                                                                                    <option value="{{$position->position_code}}" @if($positionOfStaff->position_code == $position->position_code or old('position') == $position->position_code) ? selected @endif>{{$position->position_name}}</option>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </select>
                                                                        <p>{{old('position')}}</p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong><label for="password">Mật khẩu:</label></strong></td>
                                                                    <td><input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" value="{{ old('password') }}"></td>
                                                                    <td><strong><label for="status">Trạng thái:</label></strong></td>
                                                                    <td>
                                                                        <input type="radio" name="status" id="Working" value="1" @if($staff->status == '1' or old('status') == '1') ? checked='checked' @endif>Còn làm việc
                                                                        <input type="radio" name="status" id="Retired" value="0" @if($staff->status == '0' or old('status') == '0') ? checked='checked' @endif>Đã nghĩ
                                                                    </td>
                                                                </tr>
                                                            </div>
                                                        </table>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                                        </div>
                                                    </form>
                                                    @if(old('formType') === 'updateStaffType' && $errors->any())
                                                        <div class="error-messages">
                                                            @if($errors->has('fullName'))
                                                                <span class="error-message"> * {{ $errors->first('fullName') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('imgOfStaff'))
                                                                <span class="error-message"> * {{ $errors->first('imgOfStaff') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('birthday'))
                                                                <span class="error-message"> * {{ $errors->first('birthday') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('address'))
                                                                <span class="error-message"> * {{ $errors->first('address') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('workingDay'))
                                                                <span class="error-message"> * {{ $errors->first('workingDay') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('phone'))
                                                                <span class="error-message"> * {{ $errors->first('phone') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('position'))
                                                                <span class="error-message"> * {{ $errors->first('position') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('password'))
                                                                <span class="error-message"> * {{ $errors->first('password') }} </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span id="entireDeleteStaff">
                                    <button type="button" class="btn deleteStaff btnFunction" data-bs-toggle="modal" data-bs-target="#deleteStaff">
                                        <i class="fas fa-times fa-lg" style="color: #ff0000;"></i>
                                    </button>
                                    <div class="modal fade" id="deleteStaff" tabindex="-1" aria-labelledby="deleteStaffLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <strong><h3 class="modal-title" id="deleteStaffLabel">Xoá nhân viên</h3></strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body"><p>Bạn có chắc chắn muốn xoá?</p></div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('manager.deleteStaff', ['staff_code' => $staff['staff_code']]) }}">
                                                        <button type="button" class="btn btn-danger">Xoá</button>
                                                    </a>
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
    {{-- Handle Function Staff --}}
    @if (old('formType') === 'addStaffType' && $errors->any())
        <script src="{{ asset('resources/js/staff/addstaff.js') }}"></script>
    @endif
    @if (old('formType') === 'updateStaffType' && $errors->any())
        <script src="{{ asset('resources/js/staff/updatestaff.js') }}"></script>
    @endif
    <script src="{{ asset('resources/js/master/reloadafterclosemodal.js') }}"></script>
@endsection

@section('nav-link-staffs')
    active
@endsection
