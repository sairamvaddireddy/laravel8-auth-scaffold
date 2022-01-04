@extends('layouts.app')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Token Management</h1>
    <div>
    <a href="{{ route('tokens.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Create New Token</a>
        {!! Form::open(['method' => 'DELETE','route' => ['tokens.delete-all'],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete All Tokens', ['class' => 'btn btn-sm btn-danger']) !!}
        {!! Form::close() !!}
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  {{ $message }}
</div>
@endif
@if ($tokenCode = Session::get('token'))

<div class="modal fade" id="showToken" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Generated Token</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
          <input type="text" class="form-control" readonly value="{{$tokenCode}}"  aria-label="Recipient's username" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" onclick="copyToken('{{$tokenCode}}')" type="button">Copy</button>
          </div>
        </div>
        <h4 class="d-none text-primary text-center" id="copy" >Token Copied! Please store in a safe place!!</h4>
        <p class="text-danger text-center" id="warning-text">Copy this and store it in a safe place. 
          <br>Please do not refresh the page or close the popup with out copying!</p>
      </div>
    </div>
  </div>
</div>
@endif

<div class="card shadow">
<div class="card-body">
<table class="table table-bordered">
 <tr>
   <th>ID</th>
   <th>Name</th>
   <th>Created At</th>
   <th width="280px">Action</th>
 </tr>
 @forelse ($tokens as $key => $token)
  <tr>
    <td>{{ $token->id }}</td>
    <td>{{ $token->name }}</td>
    <td>{{ $token->created_at }}</td>
    <td>
        {!! Form::open(['method' => 'DELETE','route' => ['tokens.destroy', $token->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @empty 
 <tr><td colspan="4" class="text-center font-weight-bold">No Records Found</td></tr>
  @endforelse

</table>
</div>
</div>
@endsection

@section('scripts')
    <script>
      $('document').ready(function(){
        if ($('#showToken').length) {
          $('#showToken').modal('show');
        }
        
      });

      function copyToken(token) {
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(token);
                return;
            }
            navigator.clipboard.writeText(token).then(function() {
                $('#copy').removeClass('d-none');
                $('#warning-text').addClass('d-none');
            });
        }
        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;
            // Avoid scrolling to bottom
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            console.log(textArea)
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Fallback: Copying text command was ' + msg);
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }
            document.body.removeChild(textArea);
        }
    </script>
@endsection