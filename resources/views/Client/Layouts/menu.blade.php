{{-- <nav class="main-menu navbar-expand-md navbar-light">--}}
{{--    <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--        <ul class="navigation clearfix">--}}
{{--            <?php--}}
{{--                buildMenuClient($menu,-1);--}}
{{--                function buildMenuClient($data,$parent_id){--}}
{{--                    foreach ($data as $val) {--}}
{{--                        if($val->parent_id == $parent_id) {--}}

{{--                            if(collect($data)->contains('parent_id', $val->id)){--}}
{{--                                echo "<li class='dropdown'>";--}}
{{--                            } else {--}}
{{--                                echo "<li>";--}}
{{--                            }--}}

{{--                            --}}
{{--                            if($val->type == 1){--}}
{{--                                if($val->type_id == 1){--}}
{{--                                    echo "<a href='".route('home.list.page',['id'=>$val->link_id])."' id='view_post_".$val->link_id."' ><span>".$val->name."</span></a>";--}}
{{--                                    echo "<input type='hidden' value='".$val->link_id."' class='view_post'>";--}}
{{--                                }else{--}}
{{--                                    echo "<a href='".route('home.list.post',['id'=>$val->link_id])."' id='view_post_".$val->link_id."' ><span>".$val->name."</span></a>";--}}
{{--                                }--}}
{{--                            }elseif($val->type == 2){--}}
{{--                                echo "<a href='".route('home.list.product',['id'=>$val->link_id])."' id='view_product_".$val->link_id."'><span>".$val->name."</span></a>";--}}
{{--                            }elseif($val->type == 3){--}}
{{--                                echo "<a href='".route('home.list.category.post',['id'=>$val->link_id])."' id='view_category_post_".$val->link_id."'><span>".$val->name."</span></a>";--}}
{{--                            }elseif($val->type == 4){--}}
{{--                                echo "<a href='".route('get.list.product',['id'=>$val->link_id])."' id='view_category_product_".$val->link_id."'><span>".$val->name."</span></a>";--}}
{{--                            }elseif($val->type == 5){--}}
{{--                                $url = $val->url ? $val->url : '';--}}
{{--                                echo "<a href='".$url."' id='view_url_".$val->link_id."'><span>".$val->name."</span></a>";--}}
{{--                            }--}}

{{--                            if(collect($data)->contains('parent_id', $val->id)){--}}
{{--                                echo "<ul>";--}}
{{--                                buildMenuClient($data,$val->id);--}}
{{--                                echo "</ul>";--}}
{{--                            }--}}
{{--                            echo "</li>";--}}
{{--                        }--}}
{{--                    }--}}
{{--                }--}}
{{--            ?>--}}

{{--        </ul>--}}
{{--    </div>--}}
{{--</nav>--}}
<nav class="main-menu navbar-expand-md navbar-light">
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
</div>
@section('script-client')

@endsection
