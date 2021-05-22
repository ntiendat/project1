        <!-- JAVASCRIPT -->
        <script src="{{ URL::asset('/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/metismenu/metismenu.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/node-waves/node-waves.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ URL::asset('/libs/jquery.nestable/jquery.nestable.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="{{ asset('js/all1.js') }}" defer></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @yield('script')

        <!-- App js -->
        <script src="{{ URL::asset('js/app.min.js') }}"></script>
        <script src="{{ URL::asset('js/cmsweb.js') }}"></script>
        <script src="{{ URL::asset('/libs/select2/select2.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
        <script src="{{ URL::asset('/libs/dropzone/dropzone.min.js') }}"></script>
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
        <script src="http://qovex-v.laravel.themesbrand.com/libs/simplebar/simplebar.min.js"></script>

        <!-- form advanced init -->
        <script src="{{ URL::asset('/js/pages/form-advanced.init.js') }}"></script>

        <script src="{{ URL::asset('/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
        <!-- Summernote js -->
        <script src="{{ URL::asset('/libs/summernote/summernote.min.js') }}"></script>
        <!-- form repeater js -->
        <script src="{{ URL::asset('/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
        <script src="{{ URL::asset('/js/pages/task-create.init.js') }}"></script>
        <script>
            CKEDITOR.replace('content');
            CKEDITOR.replace('short_content');
            CKEDITOR.replace('principles');
            CKEDITOR.replace('parameter');
            CKEDITOR.replace('content_en');
            CKEDITOR.replace('short_content_en');
            CKEDITOR.replace('principles_en');
            CKEDITOR.replace('parameter_en');
            $(window).on('load', function() {
                $('#content_en').ckeditor();
                $('#short_content_en').ckeditor();
                $('#principles_en').ckeditor();
                $('#parameter_en').ckeditor();

            });

        </script>

        @yield('script-bottom')
        {{-- bắt sự kiện click chọn ảnh product --}}
        <script>
             var id = 1;
            $('.modal-body').on("scroll", function() {
                
                let div = $(this).get(0);
                if (div.scrollTop + div.clientHeight >= div.scrollHeight) {
                    id = id+1;
                    console.log('bottom');
                    $.ajax({
                        url: '{{ route('more-media') }}',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            page: id
                        },
                        success: function(data) {
                        $('.img-row').append(data);
                        },
                        error: function(data) {
                            // showMessage("Đã xoá bình luận lỗi",2);
                        }
                    });
                    
                }

            });
            $('.checkbox-image').click(function() {
                if ($(this).is(':checked')) {
                    $(this).parent().addClass('addStyle-imge');
                } else {
                    $(this).parent().removeClass('addStyle-imge');
                    $(this).prop('checked', false);
                }
            });

        </script>
        <script>
            // validation không cho người dùng nhập kí tự đặc biệt
            $("input").on("keypress", function(e) {
                var val = $(this).val();
                var regex = /(<[^>]*(>|$))/ig;
                // var regex = /<(/)?(body|html|head|p|b|strong|a|i|span|div)*>/ig;
                var result = val.replace(regex, "");
                $(this).val(result);
            });

            function deletecommentproduct(e, id) {
                var tr = $(e).parents("tr");
                if (confirm("Bạn có chắc muốn xoá bình luận sản phẩm")) {
                    $.ajax({
                        url: '{{ route('delete.comment') }}',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id
                        },
                        success: function(data) {
                            console.log($(this).parents("tr"));
                            tr.remove();
                            showMessage("Đã xoá bình luận", 1);
                        },
                        error: function(data) {
                            showMessage("Đã xoá bình luận lỗi", 2);
                        }
                    });
                }
            }

        </script>

        <script>
            Dropzone.options.dropzone = {
                maxFilesize: 2, // MB
                maxFiles: 10,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                // addRemoveLinks: true, //thêm or bỏ remove
                dictFileTooBig: 'Image is larger than 2MB',
                timeout: 10000,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time + file.name;
                },
                init: function() {
                    this.on('complete', function(file) {
                        if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {

                        }
                    });
                },

                removedfile: function(file) {
                    var name = file.upload.filename;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('media.delete') }}',
                        data: {
                            filename: name
                        },
                        success: function(data) {
                            // alert(" File đã được xóa !!");
                            notify("<div style='font-size:15px'><i class='fa fa-check'></i> Đã xóa file ảnh " +
                                data + "</div>", 'error');
                            console.log(data);

                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                success: function(file, data) {
                    console.log(data);
                    $('.img-row').prepend(`<div class="col-md-2 text-center border-media-product addStyle-imge border-media-product_${            data['id']}"  >
                                    <img id="img_${data['id']}" src="../../../Media/${data['url']}" width="100%" height="100px" alt="">
                                        <input type="checkbox" checked name="media_id" class="checkbox-image" value="${data['id']}">
                                        {{-- @endif --}}
                                    </div>`);
                    $('.img-row-media').prepend(`<div class="col-md-1 img_${data['id']} image-media" style="margin-bottom:              10px;text-align: center;" id="">
                        <p style="width: 100%"><img src="../../Media/${data['url']}" style="width: 100%;height: 50px;" alt=""></p>
                        <input type="checkbox" class="checkbox-image checkbox" data-id="${data['id']}" style="display: none;margin:auto">
                        <a class=" text-center remove_image" onclick="_delete_image('${data['id']}')" style="color: blue;cursor: pointer;">Xóa ảnh</a>
                        </div>`);
                    $('.library_image').addClass('active');
                    $('.library_image').addClass('show');
                    $('.upload_image').removeClass('active');
                    $('.upload_image').removeClass('show');
                },
                queuecomplete: function(file) {
                    $('.dropzone')[0].dropzone.files.forEach(function(file) {
                        file.previewElement.remove();
                    });

                    $('.dropzone').removeClass('dz-started');
                },
                error: function(file, response) {
                    return false;
                }
            };

            $("#btn-oke").click(function() {
                $('.dropzone').val('');
            });

        </script>
        <script>
            var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) {
                toggler[i].addEventListener("click", function() {
                    this.parentElement.querySelector(".nested").classList.toggle("active");
                    this.classList.toggle("caret-down");
                });
            }

        </script>
        <script>
            //delete image modal
            $('#select-all').on('change', function() {
                if ($("#select-all option:selected").val() == 1) {
                    $("#select-all").val(0).change();
                    var idsArr = [];
                    $(".checkbox:checked").each(function() {
                        idsArr.push($(this).attr('data-id'));
                    });
                    if (idsArr.length <= 0) {
                        alert("Vui lòng chọn trước khi xoá");
                    } else {
                        if (confirm("Bạn có chắc muốn xoá các ảnh đã chọn")) {
                            var strIds = idsArr.join(
                            ","); //join: lấy hết giá trị bên trong của biến khi được join
                            // alert(strIds);
                            $.ajax({
                                url: '{{ route('delete.multiple.image.media') }}',
                                type: 'GET',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    ids: strIds
                                },
                                success: function(data) {
                                    $(".checkbox:checked").each(function() {
                                        $(this).parents(".border-media-product").remove();
                                    });
                                    notify("<div style='font-size:15px'><i class='fa fa-check'></i>Ảnh được chọn đã được xóa</div>",
                                        'error');
                                },
                                error: function(data) {
                                    alert(data);
                                }

                            });

                        }

                    }

                }

            })
            $('#myModal').on('show.bs.modal', function(event) {
                $('.img-row').find('input:checked').each(function(i) {
                    $(this).prop("checked", false);
                    $(this).parent().removeClass('addStyle-imge');
                });
            });

            $("#a-add-cate").click(function() {
                if ($("#add-cate").is(":hidden")) {
                    $("#add-cate").show();
                } else {
                    $("#add-cate").hide();
                }
            });

            var isMultiSelected = true;
            var logoicon = false;
            var favicon = false;
            $("input:checkbox").on('click', function() {
                if (isMultiSelected == false) {
                    var $box = $(this);
                    if ($box.is(":checked")) {
                        var group = "input:checkbox";
                        $(group).prop("checked", false);
                        $(group).parent().removeClass('addStyle-imge');

                        $box.prop("checked", true);
                        $box.parent().addClass('addStyle-imge');
                    } else {
                        $box.prop("checked", false);
                        $box.parent().removeClass('addStyle-imge');
                    }
                }
            });

            $('#selectoneimage').on('click', function() {
                $('#myModal').modal('show');
                isMultiSelected = false;
            });

            $('#selectFavicon').on('click', function() {
                $('#myModal').modal('show');
                isMultiSelected = false;
                favicon = true;
            });

            $('#selectLogoIcon').on('click', function() {
                $('#myModal').modal('show');
                isMultiSelected = false;
                logoicon = true;
            });

            $('#btn-oke').on('click', function() {
                if (isMultiSelected == true) {
                    var $boxes = $('input[name=media_id]:checked');
                    // alert('true');
                    var id_imgs = [];
                    $boxes.each(function() {
                        img_id = $(this).val();
                        // vardump(img_id);

                        ///Do stuff here with this
                        var img = "<div id='img_" + img_id +
                            "' class='border-image-product' style='width:96px;height:96px;position:relative;display:inline-block;margin:5px 5px 10px 5px'><img style='margin-right:5px' src='" +
                            $('.border-media-product #img_' + img_id).attr("src") +
                            "' width='100%' height='100%'><a class='delete_image_box_multi' data-id='" +
                            img_id +
                            "'><i class='fas fa-times' style='color:gray;font-size:14px;font-weight:bold;right:5px;top:5px;position: absolute'></i></a></div>";
                        $('#div_albumb').append(img);
                        id_imgs.push(img_id);
                    });
                    var imglist = $('#albumb_id').val().split(',');
                    $.each(imglist, function(index, value) {
                        if (value != '') {
                            id_imgs.push(value);
                        }
                    })
                    $('#albumb_id').val(id_imgs);
                    // alert(id_imgs);


                    $('.delete_image_box_multi').on('click', function() {

                        var id = $(this).attr("data-id");

                        var imglist = $('#albumb_id').val().split(',');
                        var list = [];
                        $.each(imglist, function(value) {
                            if (value != id && value != '') {
                                list.push(value);
                            }
                        })
                        $('#albumb_id').val(list);
                        $(this).parent().remove();
                    });

                } else {

                    var img_id = $('input[name=media_id]:checked').val();

                    if (logoicon == true) {
                        $('#img_logo').attr("src", $('#img_' + img_id + ' img').attr("src"));
                        $('#hidden_image_logo').val(img_id);
                        $('#img_thumb_logo').show();
                        logoicon = false;
                    } else if (favicon == true) {
                        $('#img_fav').attr("src", $('#img_' + img_id + ' img').attr("src"));
                        $('#hidden_image_fav').val(img_id);
                        $('#img_thumb_fav').show();
                        favicon = false;
                    } else {

                        
                        $('#img_product').attr("src", $('.border-media-product #img_' + img_id).attr("src"));

                        $('#image_pro').val(img_id);

                        $('#img_thumb').show();
                    }

                }
            });


            function remove_image($id) {
                $("#img_" + $id).hide();
                var imglist = $('#albumb_id').val().split(',');
                var list = [];
                $.each(imglist, function(index, value) {
                    if (value != $id && value != '') {
                        list.push(value);
                    }
                })
                $('#albumb_id').val(list);
            }

            //delete image product
            function delete_image(id) {
                // alert(image_id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('media.delete.image.pro') }}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // notify("<div style='font-size:15px'><i class='fa fa-check'></i> Đã xóa file ảnh</div>",'error');
                        $('#img_' + data['id']).hide();
                        var imglist = $('#albumb_id').val().split(',');//tach mot chuoi thanh moit mang cac chuoi con
                        var list = [];
                        $.each(imglist, function(index, value) {
                            if (value != id && value != '') {
                                list.push(value);// them mot muc moi vao mang
                            }
                        })
                        $('#albumb_id').val(list);
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            $('#btn-oke-galary').on('click', function() {
                var $boxes = $('input[name=media_id]:checked');
                //alert($boxes);
                var id_imgs = [];
                $('.div_albumb').empty();
                $boxes.each(function() {
                    img_id = $(this).val();
                    //alert(img_id);
                    var img = "<img style='margin-right:20px' src='" + $('#img_' + img_id).attr("src") +
                        "' width='100px' height='100px'>";
                    $('.div_albumb').append(img);
                    // alert(img_id);
                    id_imgs.push(img_id);
                });
                $('#albumb_id').val(id_imgs);
            });


            $('#btn-oke-share').on('click', function() {
                var $boxess1 = $('input[name=share_icon_c]:checked');
                var id_img;
                $('#share_icon_s').empty();
                $boxess1.each(function() {
                    img_id2 = $(this).val();
                    ///Do stuff here with this
                    var img = "<br><img src='" + $('#img_' + img_id2).attr("src") +
                        "' width='150px' height='150px'>";
                    $('#share_icon_s').append(img);
                });
                $('#hidden_media_share_icon').val($boxess1.val());
            });
            $('#btn-oke-favicon').on('click', function() {
                var $boxess2 = $('input[name=favicon]:checked');
                var id_img;
                // $('#share_icon_fa').empty();
                $boxess2.each(function() {
                    img_id1 = $(this).val();
                    ///Do stuff here with this
                    var img = "<br><img src='" + $('#img_' + img_id1).attr("src") +
                        "' width='150px' height='150px'>";
                    $('#share_icon_fa').append(img);// chen anh vào cuối phần tử #share_icon_fa
                });
                $('#hidden_media_favicon').val($boxess2.val());
            });

            $('.delete_image_box').on('click', function() {
                $('#img_product').attr("src", '');
                $('#image_pro').val('');
                $('#img_thumb').hide();
            });

            $('.delete_logo_img').on('click', function() {
                $('#img_logo').attr("src", '');
                $('#hidden_image_logo').val('');
                $('#img_thumb_logo').hide();
            });

            $('.delete_fav_img').on('click', function() {
                $('#img_fav').attr("src", '');
                $('#hidden_image_fav').val('');
                $('#img_thumb_fav').hide();
            });


            $('.delete_image_box_multi').on('click', function() {

                var id = $(this).attr("data-id");

                var imglist = $('#albumb_id').val().split(',');
                var list = [];
                $.each(imglist, function(index, value) {
                    if (value != id && value != '') {
                        list.push(value);
                    }
                })
                $('#albumb_id').val(list);


                $(this).parent().remove();
            });

        </script>
