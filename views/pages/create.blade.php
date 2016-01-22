@extends('parshcms::layout.master')

@section('additionalCss')
<link href="/yeoji/parsh-cms/css/summernote.css" rel="stylesheet">
<link href="/yeoji/parsh-cms/css/select2.min.css" rel="stylesheet">
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
                        <label>Page Category</label>
                        <select name="category_id" id="categorySelect" class="form-control">
                        </select>
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
<script src="/yeoji/parsh-cms/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 400
        });

        $('#categorySelect').select2({
            ajax: {
                url: "{{ action('\Yeoji\ParshCMS\Http\Controllers\PageCategoryController@getSearch') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 3,
            templateResult: formatCategoryResult,
            templateSelection: formatCategorySelection
        })
            .on('select2:select', function(e) {
                $.ajax("{{ action('\Yeoji\ParshCMS\Http\Controllers\PageCategoryController@postCreate') }}", {
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: e.params.data.name
                    }
                });
            });
    });

    function formatCategoryResult(category) {
        if(category.loading) return category.text;
        return "<div class='clearfix'>"+ category.name +"</div>";
    }

    function formatCategorySelection(category) {
        return category.name;
    }

    // handle retrieval of markup and submitting the form
    $('#pageSubmit').click(function () {
        var content = $('#summernote').summernote('code');
        $.ajax("{{ action('\Yeoji\ParshCMS\Http\Controllers\PageController@store') }}", {
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
                    location.reload();
                }
            });
    });
</script>
@endsection