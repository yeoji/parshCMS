<?php
namespace Yeoji\ParshCMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yeoji\ParshCMS\Repositories\Interfaces\PageCategoryRepository;

class PageCategoryController extends Controller
{
    /**
     * @var PageCategoryRepository
     */
    protected $categories;

    /**
     * @param PageCategoryRepository $categories
     */
    public function __construct(PageCategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Search for categories and if none is found, returns the original query
     * @param Request $request
     * @return mixed
     */
    public function getSearch(Request $request)
    {
        $categories = $this->categories->searchByTerm($request->get('q'));
        $addNew = ['id' => $this->categories->count() + 1, 'name' => $request->get('q')];
        if ($categories->count() > 0) {
            return Response::json(array_merge([$addNew], array_values($categories->toArray())));
        }
        return Response::json([$addNew]);
    }

    /**
     * Creates a new category if it doesn't already exist
     * @param Request $request
     */
    public function postCreate(Request $request)
    {
        // check category does not exist
        $name = ucwords(strtolower($request->get('name')));
        if (!$this->categories->findByName($name)) {
            $this->categories->create([
                'name' => $name
            ]);
        }
    }
}