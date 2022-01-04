@extends('layouts.app')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> Add New Settings</h1>
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
{!! Form::open(array('route' => 'settings.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Key:</strong>
            <input type="text" name="key" id="key" placeholder="Key" class="form-control">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Type:</strong>
            <select name="type" id="type" class="form-control">
                <option value="text">Text</option>
                <option value="text-area">Text Area</option>
                <option value="multi-select">Multi Select</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Value:</strong>
            <div id="value">
                <input class="form-control" name="value" placeholder="Value" type="text">
            </div>
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
        function showText() {
            $('#value').html('<input class="form-control" name="value" placeholder="Value" type="text">');
        }
        function showTextArea() {
            $('#value').html('<textarea class="form-control" name="value"></textarea>');
        }
        function showSelect() {
            $('#value').html('<select multiple id="" class="form-control multi-select" name="value[]"></select>');
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
        }
        $(document).ready(function() {
            $('#type').on('change', function(e){
                switch(this.value) {
                    case "text":
                        showText();
                        break;
                    case "text-area":
                        showTextArea();
                        break;
                    case "multi-select":
                        showSelect();
                        break;
                    default:
                        showText();
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