<table class="table table-striped table-hover table-primary" style="text-align: center;width: 100% !important;">
      <thead class="{{-- thead-dark --}}" style="background-color:#283d92;color: white">
          <tr>
              <th scope="col">STT</th>
              <th scope="col">Bài viết</th>
              <th scope="col">Số lượng người xem</th>
              <th scope="col">Tác vụ</th>
          </tr>
      </thead>
      <tbody id="tbody">
        <?php $stt=0; ?>
         @foreach($post_counts as $post_count)
         <tr>
          <td>{{ $stt++ }}</td>
          <td>{{ substr($post_count->title,0,40)}}</td>
          <td>{{ $post_count->count}}</td>
          <th scope="col">
              <a href="{{route('history.view',['id'=>$post_count->id])}}">Chi tiết</a>
          </tr>
          @endforeach
      </tbody>
  </table>
  {!! $post_counts->render() !!}
