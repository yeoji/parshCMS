@extends('parshcms::layout.master')

@section('additionalCss')
<link href="/yeoji/parsh-cms/css/summernote.css" rel="stylesheet">
@endsection

@section('content')
@include('parshcms::partials.messages')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add a New Page</h1>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Page Title</label>
                        <input type="text" name="title" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Page Key</label>
                        <input type="text" name="key" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Theme</label>
                        <select id="themeSelect" class="form-control">
                            @foreach($themes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Template File</label>

                        <div id="summernote"></div>
                    </div>
                    <br/>
                    <button type="button" class="btn btn-success" id="pageSubmit">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('additionalJs')
<script src="/yeoji/parsh-cms/js/summernote.min.js"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 400
        });

    });

    // handle retrieval of markup and submitting the form
    $('#pageSubmit').click(function () {
        var content = $('#summernote').summernote('code');
        $.ajax("{{ '/' . config('parshcms.route') . '/pages' }}", {
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                title: $("input[name='title']").val(),
                key: $("input[name='key']").val(),
                theme_id: $('#themeSelect').val(),
                category_id: $('#categorySelect').val(),
                content: content
            }
        })
            .done(function (res) {
                if (res.error) {
                    $('#alertError').text(res.message);
                    $('#alertError').show();
                } else {
                    location.assign("{{ action('\Yeoji\ParshCMS\Http\Controllers\PageController@index') }}");
                }
            });
    });
</script>
@endsection