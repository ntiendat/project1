<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">{{$title}}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                     @if(isset($li_1))
                      <li class="breadcrumb-item">
                        <a href="javascript: void(0);">
                          {{ $li_1 }}
                        </a>
                      </li>
                     @endif
                    <!-- App Search-->
                    <form class="app-search d-none d-lg-inline-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search">
                            <span ><i class="fa fa-search"></i></span>
                        </div>
                    </form>

                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->