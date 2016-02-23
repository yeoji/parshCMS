@extends('parshcms::layout.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit {{ $theme->title }}</h1>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <form method="post" action="{{  '/' . config('parshcms.route') . '/themes/' . $theme->id  }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE"/>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ '/' . config('parshcms.route') . '/themes/' . $theme->id }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="PUT"/>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $theme->title }}"/>
                        </div>
                        <br/><br/>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
