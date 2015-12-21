@extends('parshcms::layout.master')

@section('content')
@include('parshcms::partials.messages')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Themes Management</h1>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-2">
        <a href="themes/create" class="btn btn-success">Add Theme</a>
    </div>
</div>
<br/><br/>
<div class="row">
    @foreach($themes as $theme)
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                {{ $theme->title }} <a href="themes/{{$theme->id}}/edit" class="btn btn-default">Edit</a>
            </div>
            <div class="panel-body">
                <iframe style="width: 100%; height: 350px" src='{{ "/".config("parshcms.route")."/themes/{$theme->id}/preview" }}' scrolling="no"></iframe>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection