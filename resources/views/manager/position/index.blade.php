@extends('master')

@section('title')
    Admin - Position
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">CHỨC VỤ</h2>
        <span id="entireAddPosition">
            <button type="button" class="btn btn-primary functionNewAdd" data-bs-toggle="modal"
                data-bs-target="#addPosition">Thêm
                chức vụ</button>
            <div class="modal fade" id="addPosition" tabindex="-1" aria-labelledby="addPositionLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <strong>
                                <h3 class="modal-title" id="addPositionLabel">Thêm chức vụ</h3>
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formAddPosition" method="post" action="{{ route('manager.addPosition') }}"> @csrf
                                <div class="form-group" id="top-form">
                                    <strong><label for="positionName">Tên chức vụ:</label></strong>
                                    <input type="text" name="positionName" id="positionName" class="form-control"
                                        placeholder="Nhập tên chức vụ" value="{{ old('positionName') }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <strong><label for="salary">Lương căn bản:</label></strong>
                                    <input type="text" name="salary" id="salary" class="form-control"
                                        placeholder="Nhập lương căn bản" value="{{ old('salary') }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                            <div class="error-messages">
                                @if ($errors->has('positionName'))
                                    <span class="error-message"> * {{ $errors->first('positionName') }} </span>
                                @endif
                                <br />
                                @if ($errors->has('salary'))
                                    <span class="error-message"> * {{ $errors->first('salary') }} </span>
                                @endif
                            </div>
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
                    @foreach ($getPositions as $position)
                        <tr>
                            <td class="specificContents" style="padding-left: 1em">
                                {{ ($getPositions->currentPage() - 1) * $getPositions->perPage() + $loop->index + 1 }}</td>
                            <td class="specificContents">{{ $position->position_name }}</td>
                            <td class="specificContents">{{ number_format($position->salary) }} VNĐ</td>
                            <td>
                                <span id="entireUpdatePosition">
                                    <button type="button" class="btn updatePosition specificContents" data-bs-toggle="modal"
                                        data-bs-target="#updatePosition{{ $position->position_code }}"><i
                                            class="fas fa-tools fa-lg"
                                            style="color: #FFD43B; margin-right: 1em;"></i></button>
                                    <div class="modal fade" id="updatePosition{{ $position->position_code }}" tabindex="-1"
                                        aria-labelledby="updatePositionLabel{{ $position->position_code }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <strong>
                                                        <h3 class="modal-title"
                                                            id="updatePositionLabel{{ $position->position_code }}">Sửa chức
                                                            vụ
                                                        </h3>
                                                    </strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="formUpdatePosition" method="post"
                                                        action="{{ route('manager.updatePosition', $position->position_code) }}">
                                                        @csrf
                                                        <div class="form-group" id="top-form">
                                                            <strong><label
                                                                    for="positionName{{ $position->position_code }}">Tên
                                                                    chức vụ:</label></strong>
                                                            <input type="text" name="positionName"
                                                                id="positionName{{ $position->position_code }}"
                                                                class="form-control" placeholder="Nhập tên chức vụ"
                                                                value="{{ $position->position_name }}" autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <strong><label for="salary{{ $position->salary }}">Lương căn
                                                                    bản:</label></strong>
                                                            <input type="text" name="salary"
                                                                id="salary{{ $position->salary }}" class="form-control"
                                                                placeholder="Nhập lương căn bản"
                                                                value="{{ $position->salary }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                                        </div>
                                                    </form>
                                                    <div class="error-messages">
                                                        @if ($errors->has('positionName'))
                                                            <span class="error-message"> *
                                                                {{ $errors->first('positionName') }} </span>
                                                        @endif
                                                        <br />
                                                        @if ($errors->has('salary'))
                                                            <span class="error-message"> * {{ $errors->first('salary') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span id="entireDeletePosition">
                                    <button type="button" class="btn deletePosition specificContents" data-bs-toggle="modal"
                                        data-bs-target="#deletePosition{{ $position->position_code }}"><i
                                            class="fas fa-times fa-lg" style="color: #ff0000;"></i></button>
                                    <div class="modal fade" id="deletePosition{{ $position->position_code }}"
                                        tabindex="-1"
                                        aria-labelledby="deletePositionLabel{{ $position->position_code }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <strong>
                                                        <h3 class="modal-title"
                                                            id="deletePositionLabel{{ $position->position_code }}">Xoá
                                                            chức vụ
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
                                                    <a
                                                        href="{{ route('manager.deletePosition', ['position_code' => $position['position_code']]) }}"><button
                                                            type="button" class="btn btn-danger">Xoá</button></a>
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
    @if ($errors->any())
        <script src="{{ asset('resources/js/position/addposition.js') }}"></script>
        <script src="{{ asset('resources/js/position/updateposition.js') }}"></script>
    @endif
@endsection

@section('nav-link-positions')
    active
@endsection
