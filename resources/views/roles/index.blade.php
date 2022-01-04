@extends('layouts.app')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Role Management</h1>
    @can('role-create')
    <a href="{{ route('roles.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-plus fa-sm text-white-50"></i> Create New Role</a>
    @endcan
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
     <th>Name</th>
     <th>Permissions</th>
     <th>Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ $role->name }}</td>
        <td>{{ implode(", ", array_column($role->permissions->toArray(), 'name')) }}</td>
        <td>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>

{!! $roles->links('partials.pagination')!!}

</div>
</div>
@endsection