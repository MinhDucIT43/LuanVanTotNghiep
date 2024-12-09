@extends('master')

@section('title')
Admin - Position
@endsection

@section('content-manager')
<div id="contentPosition">
    <h2 class="title-assignment">CHỨC VỤ</h2>
    <a href="{{ route('manager.getaddposition') }}" class="addPosition"><button type="button" class="btn btn-primary">Thêm chức vụ</button></a>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPosition">
    Thêm chức vụ test
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="addPosition" tabindex="-1" aria-labelledby="addPositionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPositionLabel">Thêm chức vụ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('manager.getaddposition') }}"> @csrf
                <div class="form-group" id="top-form">
                    <label>Tên chức vụ</label>
                    <input type="text" name="positionName" id="positionName" class="form-control" placeholder="Nhập tên chức vụ" value="{{old('positionName')}}" autofocus>
                </div>
                <div class="form-group">
                    <label>Lương căn bản</label>
                    <input type="text" name="salary" id="salary" class="form-control" placeholder="Nhập lương căn bản" value="{{old('salary')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                  </div>
            </form>
            <div class="error-messages">
                @if($errors->has('positionName'))
                <span class="error-message"> * {{ $errors->first('positionName') }} </span>
                @endif
                <br />
                @if($errors->has('salary'))
                <span class="error-message"> * {{ $errors->first('salary') }} </span>
                @endif
            </div>
        </div>
      </div>
    </div>
  </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên chức vụ</th>
                <th>Lương cơ bản</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($getPositions as $position)
            <tr>
                <td style="padding-left: 1em"></td>
                <td>{{ $position->position_name }}</td>
                <td>{{ number_format($position->salary) }} VNĐ</td>
                <td>
                    <i class="fas fa-tools fa-lg" style="color: #FFD43B; margin-right: 1em;"></i>
                    <i class="fas fa-times fa-lg" style="color: #ff0000;"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('nav-link-position')
active
@endsection