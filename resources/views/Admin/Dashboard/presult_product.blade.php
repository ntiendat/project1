<table class="table table-striped table-hover table-primary" style="text-align: center;width: 100% !important;">
  <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
      <tr>
          <th scope="col">STT</th>
          <th scope="col">Sản phẩm</th>
          <th scope="col">Số lượng người xem</th>
          <th scope="col">Tác vụ</th>
      </tr>
  </thead>
  <tbody id="tbody">
    <?php $stt=0; ?>
     @foreach($product_counts as $product_count)
     <tr>
      <td>{{ $stt++ }}</td>
      <td>{{ substr($product_count->title,0,40)}}</td>
      <td>{{ $product_count->count}}</td>
      <th scope="col">
          <a href="{{route('history.view.product',['id'=>$product_count->id])}}">Chi tiết</a>
      </tr>
      @endforeach
  </tbody>
</table>
   {!! $product_counts->links() !!} 
