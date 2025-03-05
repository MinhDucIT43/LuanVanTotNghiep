@extends('master')

@section('title')
    Admin - Table
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">BÀN ĂN</h2>
        <span id="entireAddTable">
            <button type="button" class="btn btn-primary functionNewAdd" id="btn-addTable" data-bs-toggle="modal" data-bs-target="#addTable">Thêm bàn ăn</button>
            <div class="modal fade" id="addTable" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addTableLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h3 class="modal-title" id="addTableLabel">Thêm bàn ăn</h3></div>
                        <div class="modal-body">
                            <form id="formAddTable" method="post" action="{{ route('manager.addTable') }}">
                                @csrf
                                <input type="hidden" id="formType" name="formType" value="addTableType">
                                <div class="form-group" id="top-form">
                                    <strong><label for="nameTable">Tên bàn ăn:</label></strong>
                                    <input type="text" name="nameTable" id="nameTable" class="form-control" placeholder="Nhập tên bàn ăn" value="{{ old('nameTable') }}" autofocus>
                                </div>
                                <div class="form-group" id="top-form">
                                    <strong><label for="status">Trạng thái:</label></strong>
                                    <select name="status" id="status" class="form-select" aria-label="Default select example">
                                        <option selected hidden value="">Chọn trạng thái bàn</option>
                                        <option value="trống" @if(old('status') == 'trống') ? selected @endif>Bàn trống</option>
                                        <option value="có khách" @if(old('status') == 'có khách') ? selected @endif>Bàn đang có khách</option>
                                        <option value="chờ thanh toán" @if(old('status') == 'chờ thanh toán') ? selected @endif>Bàn đang chờ thanh toán</option>
                                        <option value="đặt trước" @if(old('status') == 'đặt trước') ? selected @endif>Bàn được đặt trước</option>
                                        <option value="bảo trì" @if(old('status') == 'bảo trì') ? selected @endif>Bàn đang bảo trì</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <table>
                                        <tr>
                                            <td><strong><label for="note">Ghi chú:</label></strong></td>
                                            <td><textarea name="note" id="note" cols="21" rows="6" placeholder="Ghi chú bàn ăn">{{ old('note') }}</textarea></td>
                                        </tr>
                                    </table>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="formAddTable" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                            @if(old('formType') === 'addTableType' && $errors->any())
                                <div class="error-messages">
                                    @if($errors->has('nameTable'))
                                        <span class="error-message"> * {{ $errors->first('nameTable') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('status'))
                                        <span class="error-message"> * {{ $errors->first('status') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('note'))
                                        <span class="error-message"> * {{ $errors->first('note') }} </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <span id="entireContentTableTables">
            {{-- Table Tables --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="specificContents">STT</th>
                        <th class="specificContents">Tên bàn</th>
                        <th class="specificContents">Trạng thái</th>
                        <th class="specificContents">Ghi chú</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getTables as $table)
                        <tr>
                            <td class="specificContents" style="padding-left: 1em">{{ ($getTables->currentPage() - 1) * $getTables->perPage() + $loop->index + 1 }}</td>
                            <td class="specificContents">{{ $table->nameTable }}</td>
                            <td class="specificContents">{{ $table->status }}</td>
                            <td class="specificContents">{{ $table->note }}</td>
                            <td>
                                <span id="entireUpdateTable">
                                    <button type="button" class="btn updateTable specificContents" data-bs-toggle="modal" data-bs-target="#updateTable{{ $table->id }}">
                                        <i class="fas fa-tools fa-lg" style="color: #FFD43B; margin-right: 1em;"></i>
                                    </button>
                                    <div class="modal fade" id="updateTable{{ $table->id }}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateTableLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"><h3 class="modal-title" id="updateTableLabel">Sửa bàn ăn</h3></div>
                                                <div class="modal-body">
                                                    <form id="formUpdateTable" method="post" action="{{ route('manager.updateTable', $table->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="formType" name="formType" value="updateTableType">
                                                        <div class="form-group" id="top-form">
                                                            <strong><label for="nameTable">Tên bàn ăn:</label></strong>
                                                            <input type="text" name="nameTable" id="nameTable" class="form-control" placeholder="Nhập tên bàn ăn" value="{{ old('nameTable', $table->nameTable) }}" autofocus>
                                                        </div>
                                                        <div class="form-group" id="top-form">
                                                            <strong><label for="status">Trạng thái:</label></strong>
                                                            <select name="status" id="status" class="form-select" aria-label="Default select example">
                                                                <option selected hidden value="">Chọn trạng thái bàn</option>
                                                                <option value="trống" @if(old('status') == 'trống') ? selected @endif @if($table->status == 'trống') ? selected @endif>Bàn trống</option>
                                                                <option value="có khách" @if(old('status') == 'có khách') ? selected @endif @if($table->status == 'có khách') ? selected @endif>Bàn đang có khách</option>
                                                                <option value="chờ thanh toán" @if(old('status') == 'chờ thanh toán') ? selected @endif @if($table->status == 'chờ thanh toán') ? selected @endif>Bàn đang chờ thanh toán</option>
                                                                <option value="đặt trước" @if(old('status') == 'đặt trước') ? selected @endif @if($table->status == 'đặt trước') ? selected @endif>Bàn được đặt trước</option>
                                                                <option value="bảo trì" @if(old('status') == 'bảo trì') ? selected @endif @if($table->status == 'bảo trì') ? selected @endif>Bàn đang bảo trì</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <table>
                                                                <tr>
                                                                    <td><strong><label for="note">Ghi chú:</label></strong></td>
                                                                    <td><textarea name="note" id="note" cols="21" rows="6" placeholder="Ghi chú bàn ăn">{{ old('note',$table->note) }}</textarea></td>
                                                                </tr>
                                                            </table>                                    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                                        </div>
                                                    </form>
                                                    @if(old('formType') === 'updateTableType' && $errors->any())
                                                        <div class="error-messages">
                                                            @if($errors->has('nameTable'))
                                                                <span class="error-message"> * {{ $errors->first('nameTable') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('status'))
                                                                <span class="error-message"> * {{ $errors->first('status') }} </span>
                                                            @endif
                                                            <br />
                                                            @if($errors->has('note'))
                                                                <span class="error-message"> * {{ $errors->first('note') }} </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span id="entireDeleteTable">
                                    <button type="button" class="btn deleteTable specificContents" data-bs-toggle="modal" data-bs-target="#deleteTable{{ $table->id }}">
                                        <i class="fas fa-times fa-lg" style="color: #ff0000;"></i>
                                    </button>
                                    <div class="modal fade" id="deleteTable{{ $table->id }}" tabindex="-1" aria-labelledby="deleteTableLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="deleteTableLabel">Xoá bàn ăn</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body"><p>Bạn có chắc chắn muốn xoá bàn <strong>{{$table->nameTable}}</strong>?</p></div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('manager.deleteTable', ['id' => $table['id']]) }}">
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
            {{ $getTables->links() }}
        </span>
    </div>
    {{-- Handle Function Position --}}
    @if (old('formType') === 'addTableType' && $errors->any())
        <script src="{{ asset('resources/js/table/addtable.js') }}"></script>
    @endif
    @if (old('formType') === 'updateTableType' && $errors->any())
        <script src="{{ asset('resources/js/table/updatetable.js') }}"></script>
    @endif
    <script src="{{ asset('resources/js/master/reloadafterclosemodal.js') }}"></script>
@endsection

@section('nav-link-table')
    active
@endsection
