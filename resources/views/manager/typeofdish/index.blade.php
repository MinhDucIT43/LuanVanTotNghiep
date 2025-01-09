@extends('master')

@section('title')
    Admin - Type of dish
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">LOẠI MÓN ĂN</h2>
        <span id="entireAddTypeOfDish">
            <button type="button" class="btn btn-primary functionNewAdd" id="btn-addTypeOfDish" data-bs-toggle="modal" data-bs-target="#addTypeOfDish">Thêm loại món ăn</button>
            <div class="modal fade" id="addTypeOfDish" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addTypeOfDishLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h3 class="modal-title" id="addTypeOfDishLabel">Thêm loại món ăn</h3></div>
                        <div class="modal-body">
                            <form id="formAddTypeOfDish" method="post" action="{{ route('manager.addTypeOfDish') }}">
                                @csrf
                                <input type="hidden" id="formType" name="formType" value="addTypeOfDishType">
                                <div class="form-group" id="top-form">
                                    <strong><label for="nameTypeDish">Tên loại món ăn:</label></strong>
                                    <input type="text" name="nameTypeDish" id="nameTypeDish" class="form-control" placeholder="Nhập tên loại món ăn" value="{{ old('nameTypeDish') }}" autofocus>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="formAddTypeOfDish" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                            @if(old('formType') === 'addTypeOfDishType' && $errors->any())
                                <div class="error-messages">
                                    @if($errors->has('nameTypeDish'))
                                        <span class="error-message"> * {{ $errors->first('nameTypeDish') }} </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <span id="entireContentTableTypOfDish">
            {{-- Table Type Of Dish --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="specificContents">STT</th>
                        <th class="specificContents">Tên loại món ăn</th>
                        <th class="specificContents">Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getTypeOfDish as $typeofdish)
                        <tr>
                            <td class="specificContents" style="padding-left: 1em">{{ ($getTypeOfDish->currentPage() - 1) * $getTypeOfDish->perPage() + $loop->index + 1 }}</td>
                            <td class="specificContents">{{ $typeofdish->nameTypeDish }}</td>
                            <td class="specificContents">
                                @if ($typeofdish->status == 1)
                                    <i class="fas fa-circle fa-lg" style="color: #04ff00;"></i>
                                @else
                                    <i class="fas fa-circle fa-lg" style="color: #ff0000;"></i>
                                @endif
                            </td>
                            <td>
                                <span id="entireUpdateTypeOfDish">
                                    <button type="button" class="btn updateTypeOfDish specificContents" data-bs-toggle="modal" data-bs-target="#updateTypeOfDish{{ $typeofdish->id }}">
                                        <i class="fas fa-tools fa-lg" style="color: #FFD43B; margin-right: 1em;"></i>
                                    </button>
                                    <div class="modal fade" id="updateTypeOfDish{{ $typeofdish->id }}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateTypeOfDishLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"><h3 class="modal-title" id="updateTypeOfDishLabel">Sửa loại món ăn</h3></div>
                                                <div class="modal-body">
                                                    <form id="formUpdateTypeOfDish" method="post" action="{{ route('manager.updateTypeOfDish', $typeofdish->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="formType" name="formType" value="updateTypeOfDishType">
                                                        <div class="form-group" id="top-form">
                                                            <strong><label for="nameTypeDish">Tên loại món ăn:</label></strong>
                                                            <input type="text" name="nameTypeDish" id="nameTypeDish" class="form-control" placeholder="Nhập tên loại món ăn" value="{{ old('nameTypeDish', $typeofdish->nameTypeDish) }}" autofocus>
                                                        </div>
                                                        <div class="form-group" id="top-form">
                                                            <strong><label for="salary">Trạng thái:</label></strong>
                                                            <input type="radio" name="status" id="inStock" value="1" @if(old('status', $typeofdish->status) == '1') ? checked='checked' @endif>Còn hàng
                                                            <input type="radio" name="status" id="outOfStock" value="0" @if(old('status', $typeofdish->status) == '0') ? checked='checked' @endif>Hết hàng                                                     </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                                        </div>
                                                    </form>
                                                    @if(old('formType') === 'updateTypeOfDishType' && $errors->any())
                                                        <div class="error-messages">
                                                            @if($errors->has('nameTypeDish'))
                                                                <span class="error-message"> * {{ $errors->first('nameTypeDish') }} </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span id="entireDeleteTypeOfDish">
                                    <button type="button" class="btn deleteTypeOfDish specificContents" data-bs-toggle="modal" data-bs-target="#deleteTypeOfDish{{ $typeofdish->id }}">
                                        <i class="fas fa-times fa-lg" style="color: #ff0000;"></i>
                                    </button>
                                    <div class="modal fade" id="deleteTypeOfDish{{ $typeofdish->id }}" tabindex="-1" aria-labelledby="deleteTypeOfDishLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="deleteTypeOfDishLabel">Xoá loại món ăn</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body"><p>Bạn có chắc chắn muốn xoá loại món ăn <strong>{{ $typeofdish->nameTypeDish }}</strong>?</p></div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('manager.deleteTypeOfDish', ['id' => $typeofdish['id']]) }}">
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
            {{ $getTypeOfDish->links() }}
        </span>
    </div>
    {{-- Handle Function TypeOfDish --}}
    @if (old('formType') === 'addTypeOfDishType' && $errors->any())
        <script src="{{ asset('resources/js/typeofdish/addtypeofdish.js') }}"></script>
    @endif
    @if (old('formType') === 'updateTypeOfDishType' && $errors->any())
        <script src="{{ asset('resources/js/typeofdish/updatetypeofdish.js') }}"></script>
    @endif
    <script src="{{ asset('resources/js/master/reloadafterclosemodal.js') }}"></script>
@endsection

@section('nav-link-typeofdish')
    active
@endsection
