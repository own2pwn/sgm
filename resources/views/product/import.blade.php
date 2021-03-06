@extends('layouts.admin')

@section('content')
<form class="form-horizontal bottom-margin-sm" role="form" method="POST" action="{{ url('products/import') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Import</div>
                    <div class="panel-body">

                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <label for="csv_file" class="col-md-2 control-label">File</label>

                            <div class="col-md-9">
                                <input id="csv_file" type="file" class="form-control" name="csv_file">
                                <small>* csv = comma separated values</small>
        
                                @if ($errors->has('csv_file'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('csv_file') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @include('shared.form.back', ['link' => 'products'])
                    @include('shared.form.submit')
                </div>
            </div>
        </div>
    </div>
</form>
@endsection