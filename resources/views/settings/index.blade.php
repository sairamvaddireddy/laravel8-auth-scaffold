@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Additional Settings</h1>
    <a href="{{ route('settings.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Add New</a>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif

<div class="card shadow">
<div class="card-body">
<table class="table table-bordered">
  <tr>
    <th>Key</th>
    <th>Value</th>
    <th>Actions</th>
  </tr>
 @forelse ($data as $key => $settings)
  <tr>
    <th>{{ $settings->key }}</td>
    <td>{{ $settings->value }}</td>
    <td>
      <a class="btn btn-primary" href="{{ route('settings.edit',$settings->id) }}">Edit</a>
      
        <!-- {!! Form::open(['method' => 'DELETE','route' => ['settings.destroy', $settings->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!} -->
    </td>
  </tr>
  @empty
  <tr><div class="text-center mt-3"> No Settings found, <a href="{{ route('settings.create') }}">create new</a></div></tr>
 @endforelse
</table>

{!! $data->links('partials.pagination') !!}

</div>
</div>


@endsection