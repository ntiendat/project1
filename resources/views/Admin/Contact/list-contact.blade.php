@extends('layouts.master')

@section('title') Danh sách liên hệ @endsection

@section('content')
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Danh sách liên hệ</a></li>
      </ol>
    </nav>

    <div id="page-wrapper">
        <div class="row" style="position: relative;">
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
                <span class="tatcatrangthai">Trạng thái</span>
                <select id="contact-status" name="status-contact" class="form-control" >
                    <option value="0">--</option>
                    <option value="1">Tiếp nhận</option>
                    <option value="2">Không liên lạc được</option>
                    <option value="3">Đã xử lý</option>
                </select>
                  {{-- <a href="{{route('list.processed')}}" style="margin-bottom: 5px"> Danh sách liên hệ đã được xử lý</a>   --}}
            </div>
        </div>
        <br>
        <table id="someTable"  class="table table-striped table-hover table-primary" >
            <thead >
                <tr>
                    <th class="checkbox1"><input type="checkbox" id="check_all"  name="" ></th>
                    <th scope="col" class="stt">STT</th>
                    <th scope="col"  class="ten">Tên</th>
                    <th scope="col"  class="Email">Email</th>
                    <th scope="col"  class="diachi">Địa chỉ</th>
                    <th scope="col"  class="sodienthoai">Số điện thoại</th>
                    <th scope="col"  class="noidung">Nội dung</th>
                    <th scope="col"  class="trangthai">Trạng thái</th>
                    <th scope="col"  class="tacvu">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
               <?php $stt = 1; ?>
                   @foreach($contacts as $contact)
                   <tr>
                    <th class="checkbox1"><input type="checkbox" class="checkbox" data-id="{{$contact->id}}"   ></th>
                    <td class="stt">{{ $stt++ }}</td>
                    <td><a href="{{route('get.detail.contact',['id'=>$contact->id])}}">{{ substr($contact->name,0,30) }}</a></td>
                    <td>{{ substr($contact->email,0,30) }}</td>
                    <td>{{ substr($contact->address,0,30) }}</td>
                    <td>{{ $contact->phone}}</td>
                    <td>{{ substr($contact->content,0,30) }}</td>
                    <td>
                        <select name="status-contact" class="form-control optionstatus" data-id="{{$contact->id}}">
                            <option value="0">--</option>
                            <option value="1" {{ $contact->status == 1 ? 'selected' : '' }}>Tiếp nhận</option>
                            <option value="2" {{ $contact->status == 2 ? 'selected' : '' }}>Không liên lạc được</option>
                            <option value="3" {{ $contact->status == 3 ? 'selected' : '' }}>Đã xử lý</option>
                        </select>
                    </td>
                     <td class="tacvu">
                    <a class="delete" data-id={{$contact->id}}><i class="fa fa-trash tacvu" style="color: red"></i></a>
                    </td>
                </tr>
                @endforeach 
            </tbody> 
        </table>
        <div id="pagination">
            <div class="row">{{$contacts->links()}}</div>
        </div>
    </div>

@endsection
@section('script')

     <script type="text/javascript">

            function deletecontact(e,id){
              var tr= $(e).parents("tr");
              if(confirm("Bạn có chắc muốn xoá ")){  
                    $.ajax({
                        url: '{{ route('delete.contact') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Thông tin liên hệ đã được xoá",1);
                        },error: function (data) {
                            showMessage("Thông tin liên hệ xoá bị lỗi",2);
                        }
                    });
                }
            }

            $('.delete').on('click',function(){
              var id=$(this).attr('data-id');
              var tr= $(this).parents("tr");
              if(confirm("Bạn có chắc muốn xoá ")){  
                    $.ajax({
                        url: '{{ route('delete.contact') }}',
                        type: 'GET',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Thông tin liên hệ đã được xoá",1);
                        },error: function (data) {
                            showMessage("Thông tin liên hệ xoá bị lỗi",2);
                        }
                    });
                }
            });

            //load lai ajax khi tim kiem trong trang thai
            function reloadAjax() {

                $(".optionstatus").on('change',function(){
              
                    var id = $(this).attr('data-id');
                    var status = $(this).val();
                    // alert($(this).val());
                    // alert(id);
                    saveStatus(id,status)

                });
            }
            //luu vao database
            function saveStatus(id,status) {
                $.ajax({
                    url: '{{route('update.status.contact')}}',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {id:id,status:status},
                    success: function (data) {
                       //console.log(data);
                       showMessage('Trạng thái được cập nhật',1)
                       //location.reload();
                    },
                    error: function (data) {
                        alert(data);
                    }
                });
            }
            //chon id , status_id trog trang thai
            $(".optionstatus").on('change',function(){
              
                var id = $(this).attr('data-id');
                var status = $(this).val();
                // alert($(this).val());
                // alert(id);
                saveStatus(id,status)
            });
            //xu ly tim kiem ajax luu vao database
            $("#contact-status").on('change',function(){
               var status_id = $("#contact-status option:selected" ).val();

                $.ajax({
                    url: '{{route('list.contactbystatus')}}',
                    type: 'GET',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {'status_id':status_id},
                    success: function (data) {
                       //console.log(data);
                      $('tbody').html(data.data);
                      $('#pagination').html(data.paging);
                       reloadAjax();
                    },
                    error: function (data) {
                        alert(data);
                    }

                });

            })

            //tim kiem bang ten ,email ,dia chi,sdt
            $('#search').on('keyup',function(){
                $value = $(this).val();
                $contact_status = $('#contact-status').val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('search.pendding') }}',
                    data: {
                        'search': $value,
                        'contact_status': $contact_status,
                    },
                    success:function(data){
                        $('tbody').html(data.data);
                        $('#pagination').html(data.paging);
                        reloadAjax();

                    }
                });
            })
            //xoa cac phan trong checkbox
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
    <script>
       $(document).ready(function() {
            //click vao class pagination class a sinh ra khi phan trang
            $(document).on('click', '.pagination a', function(e){
                var search_text = $('#search').val();

                var status = $("#contact-status option:selected" ).val();
                // alert(status);
                //alert(status);
                if (status != 0) {
                  //xu li mot lenh truoc khi tiep tuc 1 lenh click moi
                  e.preventDefault();
                  //lay gia tri trang page [1] la lay gia tri thang dang sau [0] la lay gia tri thang dang truoc
                  var page = $(this).attr('href').split('page=')[1];
                  fetch_data(page);
                }else{
                  // alert($value);
                  e.preventDefault();
                  //lay gia tri trang page [1] la lay gia tri thang dang sau [0] la lay gia tri thang dang truoc
                  var page = $(this).attr('href').split('page=')[1];

                  fetch_data_search(search_text,page);
                }
                
            });
            //chuyen trang trong tim kiem khi tim kiem bang thanh trang thai
            function fetch_data(page)
            {     
                //alert(page);
                
                var status = $("#contact-status option:selected" ).val();


                $.ajax({
                    type: "GET",
                    url: 'contactlist?page=' + page,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {'status_id':status},
                    success: function (data) {
                      console.log(data.paging);
                      //cap nhap lai 2 bien  data=$data['data'], data=$data['paging'], 
                       $('tbody').html(data.data);
                       $('#pagination').html(data.paging);
                       reloadAjax();
                        
                    }
                });
            }

             function fetch_data_search(search_text,page)
              {
                //alert(search_text);
                  $.ajax({
                      type: "GET",
                      url: 'search/contact?page=' + page,
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: {'search':search_text},
                      success: function (data) {
                        //cap nhap lai 2 bien  data=$data['data'], data=$data['paging'], 
                         $('tbody').html(data.data);
                         $('#pagination').html(data.paging);
                         reloadAjax();                         
                      }
                  });
              }
        });
    </script>
    
@endsection


