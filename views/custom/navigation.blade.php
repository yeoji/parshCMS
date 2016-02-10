@inject('pages', '\Yeoji\ParshCMS\Repositories\Interfaces\PageRepository')

{{-- This navbar should autogenerate links to every static page created --}}
{{-- It is also overridable by the package user --}}

@foreach($pages->all() as $page)
    <li><a href="/{{ $page->key }}">{{$page->title}}</a></li>
@endforeach
