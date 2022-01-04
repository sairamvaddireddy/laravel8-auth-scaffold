<div class="card shadow m-2">
  <div class="card-header">
    <h6 class="m-0 font-weight-bold text-primary">{{$title}}</h6>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      @foreach($array as $k => $v)
        @if(!is_array($v))
        <tr>
          <th>{{$k}}</th>
          <td>{{$v}}</td>
        </tr>
        @endif
      @endforeach
    </table>
  </div>
</div>