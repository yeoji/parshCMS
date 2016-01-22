@inject('pagesRepo', '\Yeoji\ParshCMS\Repositories\Interfaces\PageRepository')

{{-- This navbar should autogenerate links to every static page created --}}
{{-- It is also overridable by the package user --}}

@foreach($pagesRepo->getGroupedPages() as $category => $pages)
    @if($category === 0)
        @foreach($pages as $page)
            <li><a href="/{{ $page->key }}">{{$page->title}}</a></li>
        @endforeach
    @else
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                {{ $category }}  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                @foreach($pages as $i => $page)
                <li><a href="/{{ $page->key }}">{{ $page->title }}</a>
                </li>
                @if($i < $pages->count()-1) <li class="divider"></li> @endif
                @endforeach
            </ul>
        </li>
    @endif
@endforeach
