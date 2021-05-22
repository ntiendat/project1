@extends('layouts.master')

@section('title')Thông tin chi tiết @endsection

@section('content')

    {{-- @component('common-components.breadcrumb')
        @slot('title')<a href="{{route('dashboard')}}">Dashboard</a> @endslot
         @slot('title_li') Welcome to Qovex Dashboard   @endslot
     @endcomponent --}}
     <br>
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Thông tin chi tiết</a></li>
      </ol>
    </nav>
    <h3>Chi tiết liên hệ</h3>
    {{-- <div class="row" style="position: relative;">
        <div class="form div-select">
            <select name="" id="actions" class="select-all">
                <option value="0">Tác vụ</option>
                <option value="1" class="delete-all">Xoá</option>
            </select>
        </div> 
        <div class="form div-select" style="">
            <input id="search" type="text" placeholder="Tìm kiếm...">
        </div>
       <div class="form div-select " style="">
            <div class="multiselect">
                <div class="selectBox" onclick="showCheckboxes()">
                  <select>
                    <option>Tùy chọn hiện thị</option>
                  </select>
                  <div class="overSelect"></div>
                </div>
                <div id="checkboxes">
                  <div><input type="checkbox" name="ten" />Tên</div>
                  <div><input type="checkbox" name="Email" />Email</div>
                  <div><input type="checkbox" name="diachi" />Địa chỉ</div>
                  <div><input type="checkbox" name="sodienthoai" />Số điện thoại</div>
                  <div><input type="checkbox" name="noidung" />Nội dung</div>
                  <div><input type="checkbox" name="trangthai" />Trạng thái</div>
                  <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                </div>
            </div>
        </div>
        <div class="form div-add" style="">
              <a href="{{route('list.processed')}}" style="margin-bottom: 5px"> Danh sách liên hệ đã được xử lý</a>  
        </div>
    </div> --}}
    <br>
    <form  method="POST" enctype="multipart/form-data" >
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Tên</label>
                    <input class="form-control" name="name" id="name" readonly placeholder="Vui lòng nhập..." value="{{$contact->name}}" />
                    <span class="error-message" id="nameErr">{{ $errors->first('name') }}</span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email" id="email" readonly placeholder="Vui lòng nhập..." value="{{$contact->email}}" />
                    <span class="error-message" id="emailErr">{{ $errors->first('email') }}</span>
                </div>
                <div class="form-group">
                    <label>Địa chỉ </label>
                    <input class="form-control" name="address" id="address" readonly placeholder="Vui lòng nhập..." value="{{$contact->address}}" />
                    <span class="error-message" id="addressErr">{{ $errors->first('address') }}</span>
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <textarea name="content" id="content" rows="10" readonly>{{$contact->content}}</textarea>
                   
                </div>
                <div class="form-group">
                    <label>Trạng thái </label>
                    <?php
                        if($contact->status == 1){
                            $status = 'Tiếp nhận';
                        }elseif($contact->status == 2){
                            $status = 'Đã xử lý';
                        }
                        elseif($contact->status == 3){
                            $status = 'Không liên hệ được';
                        }
                    ?>
                    <input class="form-control" name="" id="" readonly placeholder="Vui lòng nhập..." value="<?php echo $status ?>" />
                </div>
            </div>
            @if($contact->status == 1)
                <a href="{{route('get.handle.contact',['id'=>$contact->id])}}" style="padding: 10px;border: 1px solid;border-radius: 5px;margin-right: 20px;" onclick="return confirm('bạn có chắc đã xử lý liên hệ này không ?')"><i class="fa fa-check-square tacvu"></i>Xử lý</a>
                <a href="{{route('get.not.contact',['id'=>$contact->id])}}" style="padding: 10px;border: 1px solid;border-radius: 5px;margin-right: 20px;" onclick="return confirm('Không liên hệ được ?')"><i class="fa fa-times-circle tacvu"></i>Không liên hệ được</a>
                <a href="{{route('delete.contact',['id'=>$contact->id])}}" style="padding: 10px;border: 1px solid;border-radius: 5px;margin-right: 20px;" onclick="return confirm('bạn có chắc muốn xóa không ?')"><i class="fa fa-trash tacvu" ></i>Xóa</a>
            @elseif($contact->status == 2)
                <a href="{{route('delete.contact',['id'=>$contact->id])}}" style="padding: 10px;border: 1px solid;border-radius: 5px;margin-right: 20px;" onclick="return confirm('bạn có chắc muốn xóa không ?')"><i class="fa fa-trash tacvu" ></i>Xóa</a>
            @elseif($contact->status == 3)
                <a href="{{route('get.handle.contact',['id'=>$contact->id])}}" style="padding: 10px;border: 1px solid;border-radius: 5px;margin-right: 20px;" onclick="return confirm('bạn có chắc đã xử lý liên hệ này không ?')"><i class="fa fa-check-square tacvu"></i>Xử lý</a>
                <a href="{{route('delete.contact',['id'=>$contact->id])}}" style="padding: 10px;border: 1px solid;border-radius: 5px;margin-right: 20px;" onclick="return confirm('bạn có chắc muốn xóa không ?')"><i class="fa fa-trash tacvu" ></i>Xóa</a>
            @endif
             
        </div>
    </form>




@endsection
{{-- @section('script')
     <script type="text/javascript">
            $('#search').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.pendding') }}',
                    data: {
                        'search': $value
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

            $('#actions').on('change',function() {
                if ($("#actions option:selected").val() == 1) {

                    $("#actions").val(0).change();  
                    var idsArr = [];  

                    $(".checkbox:checked").each(function() {  
                        idsArr.push($(this).attr('data-id'));
                    });  

                    if (idsArr.length <=0)  {  
                        alert("Vui lòng chọn trước khi xoá");  
                    } else {  
                        if(confirm("Bạn có chắc muốn xoá thông tin liên hệ đã chọn")){  
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: '{{route('delete-multiple-contact-pendding')}}',
                                type: 'GET',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: {ids:strIds},
                                success: function (data) {
                                    if (data['status']==true) {
                                        $(".checkbox:checked").each(function() {  
                                            $(this).parents("tr").remove();
                                            
                                        });
                                        alert(data['message']);
                                    } else {
                                        alert('aaa!!');
                                    }

                                },
                                error: function (data) {
                                    alert(data);
                                }

                            });

                        }  

                    }  

            }
        
        });
    </script>
@endsection --}}


