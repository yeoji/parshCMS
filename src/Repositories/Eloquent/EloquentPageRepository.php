<?php
namespace Yeoji\ParshCMS\Repositories\Eloquent;

use Yeoji\ParshCMS\Models\Eloquent\Page;
use Yeoji\ParshCMS\Repositories\Interfaces\PageRepository;

class EloquentPageRepository implements PageRepository
{
    /**
     * Returns all instances of Page.
     * @return Page
     */
    public function all()
    {
        return Page::all();
    }

    /**
     * Find the specified Page or throw an exception.
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return Page::findOrFail($id);
    }

    /**
     * Creates a new instance of Page.
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return Page::create($data);
    }

    /**
     * Returns the Page count.
     * @return mixed
     */
    public function count()
    {
        return Page::count();
    }

    public function delete($id)
    {
        return Page::destroy($id);
    }

    /**
     * Finds the Page model with the specified key
     * @param $key
     * @return mixed
     */
    public function findByKey($key)
    {
        return Page::where('key', $key)->first();
    }

    /**
     * Returns all the pages, grouped by categories if it belongs to any.
     * @return mixed
     */
    public function getGroupedPages()
    {
        return Page::with('category')->get()->groupBy(function($item, $key) {
            return $item->category ? $item->category->name : '0';
        });
    }
}