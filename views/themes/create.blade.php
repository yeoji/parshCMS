@extends('parshcms::layout.master')

@section('content')
@include('parshcms::partials.messages')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add a New Theme</h1>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" action="{{ action('\Yeoji\ParshCMS\Http\Controllers\ThemeController@store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Template File</label>
                            <input type="file" name="template_file" class="form-control" />
                            <p class="help-block">Upload a template with filename *.blade.php</p>
                        </div>
                        <br/><br/>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                    <div class="col-lg-6">
                        {{-- possibly preview the template here after upload --}}
                        <h4>Template Preview</h4>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection