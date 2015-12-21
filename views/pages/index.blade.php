@extends('parshcms::layout.master')

@section('content')
@include('parshcms::partials.messages')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pages Management</h1>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-2">
        <a href="pages/create" class="btn btn-success">Add Page</a>
    </div>
</div>
<br/><br/>
<div class="row">
    @foreach($pages as $page)
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                {{ $page->key }} <a href="pages/{{$page->id}}/edit" class="btn btn-default">Edit</a>
            </div>
            <div class="panel-body">
                <iframe style="width: 100%; height: 350px" src='{{ "/parsh-admin/pages/{$page->key}" }}' scrolling="no"></iframe>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection