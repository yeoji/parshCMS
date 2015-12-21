<?php
namespace Yeoji\ParshCMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yeoji\ParshCMS\Repositories\Interfaces\PageRepository;
use Yeoji\ParshCMS\Repositories\Interfaces\ThemeRepository;

class PageController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $pages;
    /**
     * @var ThemeRepository
     */
    protected $themes;

    /**
     * @param PageRepository $pages
     * @param ThemeRepository $themes
     */
    public function __construct(PageRepository $pages, ThemeRepository $themes)
    {
        $this->pages = $pages;
        $this->themes = $themes;
    }

    /**
     * Retrieves a list of the resource
     * GET /pages
     */
    public function index()
    {
        $pages = $this->pages->all();
        return view('parshcms::pages.index', ['pages' => $pages]);
    }

    /**
     * Shows the form to create a resource
     * GET /pages/create
     */
    public function create()
    {
        $themes = $this->themes->all();
        return view('parshcms::pages.create', ['themes' => $themes]);
    }

    /**
     * Stores the resource in database
     * POST /pages
     * @param Request $request
     */
    public function store(Request $request)
    {
        // find if theme exists
        $theme = $this->themes->findOrFail($request->get('theme_id'));
        $page = $theme->addPage($request->only(['key', 'content']));
        if ($page) {
            return Response::json(['error' => false]);
        }
        return Response::json(['error' => true, 'message' => 'Could not create page, please try again!']);
    }

    /**
     * Shows the page
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $page = $this->pages->findOrFail($id);
        preg_match('/(.+)\.blade\.php/', $page->theme->filename, $name);

        return view("parshcms::pages.base-template", ['themeFile' => $name[1], 'content' => $page->content->content]);
    }
}