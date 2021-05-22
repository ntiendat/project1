@extends('layouts.master')

@section('title') Danh sách form @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách form</a></li>
      </ol>
    </nav>
    <div id="page-wrapper">
        <div class="row" style="position: relative;">
            <div class="form div-select">
                <select name="" id="actions" class="select-all">
                    <option value="0">Tác vụ</option>
                    <option value="1" class="delete-all" data-url="">Xoá</option>              
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
                      <div><input type="checkbox" name="tenform" />Tên form</div>
                      <div><input type="checkbox" name="tacvu" />Tác vụ</div>
                    </div>
                    
                  </div>
            </div>
            <div class="form div-add" style="">
                  <a href="{{route('create.form')}}" class="btn btn-warning" style="margin-bottom: 5px"><i class="fa fa-plus"></i> Thêm mới</a>  
            </div>
        </div>
        <br>
         <table id="someTable" class="table table-striped table-hover table-primary">
                <thead >
                    <tr>
                        <th class="checkbox1"><input type="checkbox" id="check_all"  name=""></th>
                        <th scope="col" class="stt">STT</th>
                        <th scope="col" class="tenform">Tên form</th>
                        <!-- <th scope="col">Gía trị</th> -->
                        <th scope="col" class="tacvu" >Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach($forms as $form)
                    <tr>
                        <th class="checkbox1"><input type="checkbox" class="checkbox" data-id="{{$form->id}}"   name=""></th>
                        <td class="stt">{{ $stt++ }}</td>
                        <td>{{substr($form->name,0,50)}}</td>
                        <!-- <td>
                            {!! substr($form->value,0,30) !!}
                        </td> -->
                        <th scope="col" class="tacvu">
                            <a href="{{route('edit.form',['id'=>$form->id])}}"><i class="fa fa-edit tacvu"></i></a>
                            <a class="delete" data-id={{$form->id}}><i class="fa fa-trash tacvu" style="color: red"></i></a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>

@endsection

@section('script')
     <script type="text/javascript">

            $('.delete').on('click',function(){
              var id=$(this).attr('data-id');
              var tr= $(this).parents("tr");
              if(confirm("Bạn có chắc muốn xoá Form")){  
                    $.ajax({
                        url: '{{ route('delete.form') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Form đã được xoá",1);
                        },error: function (data) {
                            showMessage("Form xoá bị lỗi",2);
                        }
                    });
                }
            });

            $('#search').on('keyup',function(){
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.form') }}',
                    data: {
                        'search': $value
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            //xoa cot trong selected
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
                        if(confirm("Bạn có chắc muốn xoá các Form đã chọn")){  
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: '{{route('delete-multiple-form')}}',
                                type: 'GET',
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: {a:strIds},
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
@endsection





