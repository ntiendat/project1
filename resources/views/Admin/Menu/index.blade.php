
@extends('layouts.master')

@section('title') Menu @endsection

@section('content')

    {{-- @component('common-components.breadcrumb')
         @slot('title') Dashboard   @endslot
         @slot('title_li') Welcome to Qovex Dashboard   @endslot
     @endcomponent --}}
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách menu</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
    <div class="row" style="position: relative;">
        <div class="form div-select">
            <select name="" id="" class="select-all">
                <option value="">Tác vụ</option>
                <option value="">Tác vụ</option>
                <option value="">Tác vụ</option>
                <option value="">Tác vụ</option>
            </select>
        </div> 
        <div class="form div-select" style="">
            <input type="text" placeholder="Tìm kiếm...">
        </div>
        <div class="form div-select " style="">
            <select name="" id=""class="select-all">
                <option value="">Tìm theo</option>
                <option value="">Tìm theo</option>
                <option value="">Tìm theo</option>
                <option value="">Tìm theo</option>
            </select>
        </div>
        <div class="form div-select " style="">
            <select name="" id=""class="select-all">
                <option value="">Số hiển thị</option>
                <option value="">Số hiển thị</option>
                <option value="">Số hiển thị</option>
                <option value="">Số hiển thị</option>
            </select>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('create.menu')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
        </div>
    </div>
    <br>
     <table class="table table-striped table-hover table-primary" style="text-align: center;width: 100% !important;">
            <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
            <tr>
                <th><input type="checkbox"  name=""></th>
                <th scope="col">STT</th>
                <th scope="col">Tên menu</th>
                <th scope="col">Tiêu đề menu</th>
                <th scope="col">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php $stt =1 ?>
            @foreach($menus as $menu)
            <tr>
                <th><input type="checkbox"  name=""></th>
                <th scope="col">{{$stt++}}</th>
                <th scope="col">{{$menu->menu_name}}</th>
                <th scope="col">{{$menu->title}}</th>
                <th scope="col"><a href="{{route('edit.menu',['id'=>$menu->id])}}"><i class="fa fa-edit tacvu"></i></a><a href="{{route('delete.menu',['id'=>$menu->id])}}" onclick="return confirm('bạn có chắc muốn xóa không ?')"><i class="fa fa-trash tacvu" style="color: red"></i></a></th>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{-- <div class="row">{{$menus->links()}}</div> --}}
    </div>
@endsection


