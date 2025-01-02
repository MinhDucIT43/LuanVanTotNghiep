@extends('master')

@section('title')
    Admin - Position
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">CHỨC VỤ</h2>
        <span id="entireAddPosition">
            <button type="button" class="btn btn-primary functionNewAdd" id="btn-addPosition" data-bs-toggle="modal" data-bs-target="#addPosition">Thêm chức vụ</button>
            <div class="modal fade" id="addPosition" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addPositionLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><strong><h3 class="modal-title" id="addPositionLabel">Thêm chức vụ</h3></strong></div>
                        <div class="modal-body">
                            <form id="formAddPosition" method="post" action="{{ route('manager.addPosition') }}">
                                @csrf
                                <input type="hidden" id="formType" name="formType" value="addPositionType">
                                <div class="form-group" id="top-form">
                                    <strong><label for="positioname">Tên chức vụ:</label></strong>
                                    <input type="text" name="positionName" id="positionName" class="form-control" placeholder="Nhập tên chức vụ" value="{{ old('positionName') }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <strong><label for="salary">Lương căn bản:</label></strong>
                                    <input type="text" name="salary" id="salary" class="form-control" placeholder="Nhập lương căn bản" value="{{ old('salary') }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="formAddPosition" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                            @if(old('formType') === 'addPositionType' && $errors->any())
                                <div class="error-messages">
                                    @if($errors->has('positionName'))
                                        <span class="error-message"> * {{ $errors->first('positionName') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('salary'))
                                        <span class="error-message"> * {{ $errors->first('salary') }} </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <span id="entireContentTablePosition">
            {{-- Table Position --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="specificContents">STT</th>
                        <th class="specificContents">Tên chức vụ</th>
                        <th class="specificContents">Lương cơ bản</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getPositions as $position)
                        <tr>
                            <td class="specificContents" style="padding-left: 1em">{{ ($getPositions->currentPage() - 1) * $getPositions->perPage() + $loop->index + 1 }}</td>
                            <td class="specificContents">{{ $position->position_name }}</td>
                            <td class="specificContents">{{ number_format($position->salary) }} VNĐ</td>
                            <td>
                                <span id="entireUpdatePosition">
                                    <button type="button" class="btn updatePosition specificContents" data-bs-toggle="modal" data-bs-target="#updatePosition{{ $position->position_code }}">
                                        <i class="fas fa-tools fa-lg" style="color: #FFD43B; margin-right: 1em;"></i>
                                    </button>
                                    <div class="modal fade" id="updatePosition{{ $position->position_code }}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updatePositionLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"><strong><h3 class="modal-title" id="updatePositionLabel">Sửa chức vụ</h3></strong></div>
                                                <div class="modal-body">
                                                    <form id="formUpdatePosition" method="post" action="{{ route('manager.updatePosition', $position->position_code) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="formType" name="formType" value="updatePositionType">
                                                        <div class="form-group" id="top-form">
                                                            <strong><label for="positionName">Tên chức vụ:</label></strong>
                                                            <input type="text" name="positionName" id="positionName" class="form-control" placeholder="Nhập tên chức vụ" value="{{ old('positionName', $position->position_name) }}" autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <strong><label for="salary">Lương căn bản:</label></strong>
                                                            <input type="text" name="salary" id="salary" class="form-control" placeholder="Nhập lương căn bản" value="{{ old('salary', $position->salary) }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                                        </div>
                                                    </form>
                                                    @if(old('formType') === 'updatePositionType' && $errors->any())
                                                        <div class="error-messages">
                                                            @if($errors->has('positionName'))
                                                                <span class="error-message"> * {{ $errors->first('positionName') }} </span>
                                                            @endif
                                                            <br />
                                                            @if ($errors->has('salary'))
                                                                <span class="error-message"> * {{ $errors->first('salary') }} </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span id="entireDeletePosition">
                                    <button type="button" class="btn deletePosition specificContents" data-bs-toggle="modal" data-bs-target="#deletePosition{{ $position->position_code }}">
                                        <i class="fas fa-times fa-lg" style="color: #ff0000;"></i>
                                    </button>
                                    <div class="modal fade" id="deletePosition{{ $position->position_code }}" tabindex="-1" aria-labelledby="deletePositionLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <strong><h3 class="modal-title" id="deletePositionLabel">Xoá chức vụ</h3></strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body"><p>Bạn có chắc chắn muốn xoá?</p></div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('manager.deletePosition', ['position_code' => $position['position_code']]) }}">
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
        <span id="simplePaginate">
            {{ $getPositions->links() }}
        </span>
    </div>
    {{-- Handle Function Position --}}
    @if (old('formType') === 'addPositionType' && $errors->any())
        <script src="{{ asset('resources/js/position/addposition.js') }}"></script>
    @endif
    @if (old('formType') === 'updatePositionType' && $errors->any())
        <script src="{{ asset('resources/js/position/updateposition.js') }}"></script>
    @endif
    <script src="{{ asset('resources/js/master/reloadafterclosemodal.js') }}"></script>
@endsection

@section('nav-link-positions')
    active
@endsection
