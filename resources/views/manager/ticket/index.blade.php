@extends('master')

@section('title')
    Admin - Ticket
@endsection

@section('content-manager')
    <div class="contentFunction">
        <h2 class="title-assignment">Vé Buffet</h2>
        <span id="entireAddTicket">
            <button type="button" class="btn btn-primary functionNewAdd" id="btn-addTicket" data-bs-toggle="modal" data-bs-target="#addTicket">Thêm vé buffet</button>
            <div class="modal fade" id="addTicket" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addTicketLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h3 class="modal-title" id="addTicketLabel">Thêm vé buffet</h3></div>
                        <div class="modal-body">
                            <form id="formAddTicket" method="post" action="{{ route('manager.addTicket') }}">
                                @csrf
                                <input type="hidden" id="formType" name="formType" value="addTicketType">
                                <div class="form-group" id="top-form">
                                    <strong><label for="nameTicket">Tên vé buffet:</label></strong>
                                    <input type="text" name="nameTicket" id="nameTicket" class="form-control" placeholder="Nhập tên vé buffet" value="{{ old('nameTicket') }}" autofocus>
                                </div>
                                <div class="form-group">
                                    <strong><label for="price">Giá vé:</label></strong>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Nhập giá vé buffet" value="{{ old('price') }}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="formAddTicket" class="btn btn-primary">Thêm</button>
                                </div>
                            </form>
                            @if(old('formType') === 'addTicketType' && $errors->any())
                                <div class="error-messages">
                                    @if($errors->has('nameTicket'))
                                        <span class="error-message"> * {{ $errors->first('nameTicket') }} </span>
                                    @endif
                                    <br />
                                    @if($errors->has('price'))
                                        <span class="error-message"> * {{ $errors->first('price') }} </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </span>
        <span id="entireContentTableTicket">
            {{-- Table Ticket --}}
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="specificContents">STT</th>
                        <th class="specificContents">Tên vé buffet</th>
                        <th class="specificContents">Giá vé</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($getTickets as $ticket)
                        <tr>
                            <td class="specificContents" style="padding-left: 1em">{{ ($getTickets->currentPage() - 1) * $getTickets->perPage() + $loop->index + 1 }}</td>
                            <td class="specificContents">{{ $ticket->nameTicket }}</td>
                            <td class="specificContents">{{ number_format($ticket->price) }} VNĐ</td>
                            <td>
                                <span id="entireUpdateTicket">
                                    <button type="button" class="btn updateTicket specificContents" data-bs-toggle="modal" data-bs-target="#updateTicket{{ $ticket->id }}">
                                        <i class="fas fa-tools fa-lg" style="color: #FFD43B; margin-right: 1em;"></i>
                                    </button>
                                    <div class="modal fade" id="updateTicket{{ $ticket->id }}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updateTicketLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"><h3 class="modal-title" id="updateTicketLabel">Sửa vé buffet</h3></div>
                                                <div class="modal-body">
                                                    <form id="formUpdateTicket" method="post" action="{{ route('manager.updateTicket', $ticket->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" id="formType" name="formType" value="updateTicketType">
                                                        <div class="form-group" id="top-form">
                                                            <strong><label for="nameTicket">Tên vé buffet:</label></strong>
                                                            <input type="text" name="nameTicket" id="nameTicket" class="form-control" placeholder="Nhập tên vé buffet" value="{{ old('nameTicket', $ticket->nameTicket) }}" autofocus>
                                                        </div>
                                                        <div class="form-group">
                                                            <strong><label for="price">Giá vé buffet:</label></strong>
                                                            <input type="text" name="price" id="price" class="form-control" placeholder="Nhập giá vé buffet" value="{{ old('price', $ticket->price) }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Sửa</button>
                                                        </div>
                                                    </form>
                                                    @if(old('formType') === 'updateTicketType' && $errors->any())
                                                        <div class="error-messages">
                                                            @if($errors->has('nameTicket'))
                                                                <span class="error-message"> * {{ $errors->first('nameTicket') }} </span>
                                                            @endif
                                                            <br />
                                                            @if ($errors->has('price'))
                                                                <span class="error-message"> * {{ $errors->first('price') }} </span>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span id="entireDeleteTicket">
                                    <button type="button" class="btn deleteTicket specificContents" data-bs-toggle="modal" data-bs-target="#deleteTicket{{ $ticket->id }}">
                                        <i class="fas fa-times fa-lg" style="color: #ff0000;"></i>
                                    </button>
                                    <div class="modal fade" id="deleteTicket{{ $ticket->id }}" tabindex="-1" aria-labelledby="deleteTicketLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="deleteTicketLabel">Xoá vé buffet</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body"><p>Bạn có chắc chắn muốn xoá vé buffet <strong>{{$ticket->nameTicket}}</strong>?</p></div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('manager.deleteTicket', ['id' => $ticket['id']]) }}">
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
            {{ $getTickets->links() }}
        </span>
    </div>
    {{-- Handle Function Ticket --}}
    @if (old('formType') === 'addTicketType' && $errors->any())
        <script src="{{ asset('resources/js/ticket/addticket.js') }}"></script>
    @endif
    @if (old('formType') === 'updateTicketType' && $errors->any())
        <script src="{{ asset('resources/js/ticket/updateticket.js') }}"></script>
    @endif
    <script src="{{ asset('resources/js/master/reloadafterclosemodal.js') }}"></script>
@endsection

@section('nav-link-ticket')
    active
@endsection
