

@extends('layouts.master')

@section('title') Lịch sử chi tiết @endsection

@section('content')
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home"></i><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#">Lịch sử chi tiết</a></li>
        </ol>
      </nav>

    <div id="page-wrapper">
    @if($history_products_name != null && $history_products != null )
    <h3>Lịch sử chi tiết sản phẩm: {{$history_products_name['title']}} </h3>
    <table class="table table-striped table-hover table-primary" style="text-align: center;width: 100% !important;">
        <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
            <tr>
                
                <th scope="col">STT</th>
                <th scope="col">IP</th>
                <th scope="col">Location</th>
                <th scope="col">Ngày xem</th>
            </tr>
        </thead>
        <tbody>
           <?php $stt = 1; ?>
               @foreach($history_products as $history_product)
               <tr>
                
                <td>{{ $stt++ }}</td>
                <td>{{ $history_product->ip}}</td>
                <td>{{ $history_product->location}}</td>
                <td>{{ Carbon\Carbon::parse($history_product->created_at)->format('h:i')}} | {{ Carbon\Carbon::parse($history_product->created_at)->format('d-m-Y')}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">{{$history_products->links()}}</div>
    @else
      <h3>Sản phẩm chưa có lượt xem nào</h3>
    @endif
    </div>
@endsection


@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
  <!-- plugin js -->
  <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>
  
  <!-- jquery.vectormap map -->
  <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>
  
  <!-- Calendar init -->
  <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
        
@endsection