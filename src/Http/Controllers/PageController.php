<?php
namespace Yeoji\ParshCMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Yeoji\ParshCMS\Repositories\Interfaces\PageCategoryRepository;
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
     * @var PageCategoryRepository
     */
    protected $categories;

    /**
     * @param PageRepository $pages
     * @param ThemeRepository $themes
     * @param PageCategoryRepository $categories
     */
    public function __construct(PageRepository $pages, ThemeRepository $themes, PageCategoryRepository $categories)
    {
        $this->pages = $pages;
        $this->themes = $themes;
        $this->categories = $categories;
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
        $category = $request->has('category_id') ? $this->categories->findOrFail($request->get('category_id')) : null;
        $page = $theme->addPage($request->only(['key', 'content', 'title']), $category);
        if ($page) {
            return Response::json(['error' => false]);
        }
        return Response::json(['error' => true, 'message' => 'Could not create page, please try again!']);
    }

    /**
     * Shows the page matching the page key
     * @param $key
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($key)
    {
        $page = $this->pages->findByKey($key);
        if(!$page) {
            abort(404);
        }
        preg_match('/(.+)\.blade\.php/', $page->theme->filename, $name);

        return view("parshcms::pages.base-template", [
            'themeFile' => $name[1],
            'content' => $page->content->content,
            'title' => $page->title
        ]);
    }

    /**
     * Shows the form to update the page
     * GET /page/{id}/edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $page = $this->pages->findOrFail($id);
        return view("parshcms::pages.edit", ['page' => $page, 'themes' => $this->themes->all()]);
    }

    /**
     * Updates the page record in the database
     * PUT /pages/{id}
     * @param $id
     * @param Request $request
     */
    public function update($id, Request $request)
    {
        // find if theme and page exists
        $page = $this->pages->findOrFail($id);
        $theme = $this->themes->findOrFail($request->get('theme_id'));

        $page->updateContent($request->get('content'));
        $page->updateTheme($theme->id);
        $page->updateKey($request->get('key'));
        $page->updateTitle($request->get('title'));

        return Response::json(['error' => false]);
    }

    /**
     * Deletes the page
     * DELETE /pages/{id}
     * @param $id
     */
    public function destroy($id)
    {
        $page = $this->pages->findOrFail($id);
        $page->deletePage();

        return Redirect::to('/'.config('parshcms.route').'/pages')->with('message', 'Page has been deleted');
    }
}