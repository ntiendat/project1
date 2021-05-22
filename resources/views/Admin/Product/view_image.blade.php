@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')    
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách sản phẩm</a></li>
      </ol>
      
    </nav>
     <style>
        .form{
            padding: 4px;
            display: flex;
            margin-top: 10px;
        }
        
        .select-all{
            width: 100%;
            padding: 3px 6px;
        }
        .div-add{
            position: absolute;
            right: 0px;
            margin: 11px;

        }   
        i.tacvu{
            color:red;
            font-size: 15px;
            margin-left: 5px;
        }
        .div-select{
            margin-left: 10px;
        }
    </style>
    <div class="row" style="position: relative;">
        <div class="form">
            <div class="div-select">
                <select name="" id="" class="select-all">
                    <option value="">Tác vụ</option>
                    <option value="">Tác vụ</option>
                    <option value="">Tác vụ</option>
                    <option value="">Tác vụ</option>
                </select>
            </div> 
            <div class="div-select" style="">
                <select name="" id=""class="select-all">
                    <option value="">Tìm theo</option>
                    <option value="">Tìm theo</option>
                    <option value="">Tìm theo</option>
                    <option value="">Tìm theo</option>
                </select>
            </div>
            <div class="div-select" style="">
                <select name="" id=""class="select-all">
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                    <option value="">Số hiển thị</option>
                </select>
            </div>
        </div>
        <div  style="" class="form-controller" id="search" name="search">
              <input type="text" placeholder="Tìm kiếm...">
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($index_media as $index_media)
        <div class="col-md-2 img_{{$index_media->id}} text-center" style="margin-bottom: 10px ">
            <p style="width: 100%"><img src="../../Media/{{$index_media->url}}" style="width: 100%;height: 100px;" alt=""></p>
            <button type="button" class="btn btn-warning text-center remove_image" onclick="delete_image('{{$index_media->id}}')">Xóa</button>
        </div>
        @endforeach
    </div>
    
@endsection
