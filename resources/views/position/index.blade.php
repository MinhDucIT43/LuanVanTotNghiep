@extends('master')

@section('title')
Admin - Position
@endsection

@section('content-manager')
<div id="contentPosition">
    <h2 class="title-assignment">CHỨC VỤ</h2>
    <a href="#" class="addPosition"><button type="button" class="btn btn-primary">Thêm chức vụ</button></a>
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