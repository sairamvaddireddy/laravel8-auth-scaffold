@extends('layouts.app')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Setting</h1>
    <a href="{{ route('settings.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-caret-left fa-sm text-white-50"></i> Back</a>
</div>

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

<div class="card shadow">
<div class="card-body">
{!! Form::model($setting, ['method' => 'PATCH','route' => ['settings.update', $setting->id]]) !!}
<input type="hidden" value="{{$setting->id}}" name="id">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Key:</strong>
            <input type="text" name="key" value="{{$setting->key}}"  id="key" placeholder="Key" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Value:</strong>
                @switch($setting->type)
                    @case("text-area")
                        <textarea class="form-control" name="value"></textarea>
                        @break
                    @case("multi-select")
                        @php $values = explode(",", $setting->value); @endphp
                        <select multiple class="form-control multi-select" name="value[]">
                            @foreach($values as $value) 
                                <option value="{{$value}}" selected>{{ $value }}</option>
                            @endforeach
                        </select>
                        @break
                    @default
                        <input class="form-control" name="value" value="{{$setting->value}}" type="text">
                @endswitch
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
</div>
</div>
@endsection
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section("scripts")
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.multi-select').select2({
                placeholder: "Paste values separated by commas...",
                tags: true,
                tokenSeparators: [","],
                createTag: function(newTag) {
                    return {
                        id: newTag.term,
                        text: newTag.term + ' '
                    };
                }
            });
        });
        $("#key").keyup(function() {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            var regExp = /\s+/g;
            Text = Text.replace(regExp,'-');
            $("#key ").val(Text);        
        });
    </script>
@endsection
