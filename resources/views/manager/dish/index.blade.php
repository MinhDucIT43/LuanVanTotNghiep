@extends('master')

@section('title')
    Admin - Dish
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">MÓN ĂN</h2>
        <span id="entireAddDish">
            <button type="button" class="btn btn-primary functionNewAdd" id="btn-addDish" data-bs-toggle="modal" data-bs-target="#addDish">Thêm món ăn</button>
            <div class="modal fade" id="addDish" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addDishLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h3 class="modal-title" id="addDishLabel">Thêm món ăn</h3></div>
                        <div class="modal-body">
                            <form id="formAddDish" method="post" action="{{ route('manager.addDish') }}">
                                @csrf
                                <input type="hidden" id="formType" name="formType" value="addDishType">
                                <div class="form-group" id="top-form">
                                    <strong><label for="nameDish">Tên món ăn:</label></strong>
                                    <input type="text" name="nameDish" id="nameDish" class="form-control" placeholder="Nhập tên món ăn" value="{{ old('nameDish') }}" autofocus>
                                </div>
                                <div class="form-group" id="top-form">
                                    <strong><label for="price">Giá món ăn:</label></strong>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Nhập giá món ăn" value="{{ old('price') }}">
                                </div>
                                <div class="form-group" id="top-form">
                                    <strong><label for="typeofdish">Chọn loại món ăn:</label></strong>
                                    <select name="typeOfDish" id="typeOfDish" class="form-select" aria-label="Default select example">
                                        <option selected hidden value="">Thuộc loại</option>
                                        @foreach(App\Models\typeofdish::all() as $typeofdish)
                                            <option value="{{$typeofdish->id}}" @if(old('typeOfDish') == $typeofdish->id) ? selected @endif>{{$typeofdish->nameTypeDish}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="formAddDish" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                            @if(old('formType') === 'addDishType' && $errors->any())
                                <div class="error-messages">
                                    @if($errors->has('nameDish'))
                                        <span class="error-message"> * {{ $errors->first('nameDish') }} </span>
                                    @endif
                                    <br/>
                                    @if($errors->has('price'))
                                        <span class="error-message"> * {{ $errors->first('price') }} </span>
                                    @endif
                                    <br/>
                                    @if($errors->has('typeOfDish'))
                                        <span class="error-message"> * {{ $errors->first('typeOfDish') }} </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <span id="entireContentTableDish">
            {{-- Table Dish --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="specificContents">STT</th>
                        <th class="specificContents">Tên món ăn</th>
                        <th class="specificContents">Giá</th>
                        <th class="specificContents">Trạng thái</th>
                        <th class="specificContents">Thuộc loại</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getDish as $dish)
                        <tr>
                            <td class="specificContents" style="padding-left: 1em">{{ ($getDish->currentPage() - 1) * $getDish->perPage() + $loop->index + 1 }}</td>
                            <td class="specificContents">{{ $dish->nameDish }}</td>
                            <td class="specificContents">{{ number_format($dish->price) }} VNĐ</td>
                            <td class="specificContents">
                                @if ($dish->status == 1)
                                    <i class="fas fa-circle fa-lg" style="color: #04ff00;"></i>
                                @else
                                    <i class="fas fa-circle fa-lg" style="color: #ff0000;"></i>
                                @endif
                            </td>
                            <td class="specificContents">{{ App\Models\typeofdish::where('id', $dish['typeofdish_id'])->value('nameTypeDish') }}</td>
                            <td>
                                <span id="entireUpdateTypeOfDish">
                                    <button type="button" class="btn updateTypeOfDish specificContents" data-bs-toggle="modal" data-bs-target="#updateTypeOfDish{{ $typeofdish->id }}">
                                        <i class="fas fa-tools fa-lg" style="color: #FFD43B; margin-right: 1em;"></i>
                                    </button>
                                    {{-- <div class="modal fade" id="updateTypeOfDish{{ $typeofdish->id }}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateTypeOfDishLabel" aria-hidden="true">
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
                                    </div> --}}
                                </span>
                                <span id="entireDeleteTypeOfDish">
                                    <button type="button" class="btn deleteTypeOfDish specificContents" data-bs-toggle="modal" data-bs-target="#deleteTypeOfDish{{ $typeofdish->id }}">
                                        <i class="fas fa-times fa-lg" style="color: #ff0000;"></i>
                                    </button>
                                    {{-- <div class="modal fade" id="deleteTypeOfDish{{ $typeofdish->id }}" tabindex="-1" aria-labelledby="deleteTypeOfDishLabel" aria-hidden="true">
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
                                    </div> --}}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </span>
        <span id="simplePaginate">
            {{ $getDish->links() }}
        </span>
    </div>
    {{-- Handle Function Dish --}}
    @if (old('formType') === 'addDishType' && $errors->any())
        <script src="{{ asset('resources/js/dish/adddish.js') }}"></script>
    @endif
    {{-- @if (old('formType') === 'updateTypeOfDishType' && $errors->any())
        <script src="{{ asset('resources/js/typeofdish/updatetypeofdish.js') }}"></script>
    @endif --}}
    <script src="{{ asset('resources/js/master/reloadafterclosemodal.js') }}"></script>
@endsection

@section('nav-link-dish')
    active
@endsection
