<?php
namespace Yeoji\ParshCMS\Repositories\Eloquent;

use Yeoji\ParshCMS\Models\Eloquent\PageCategory;
use Yeoji\ParshCMS\Repositories\Interfaces\PageCategoryRepository;

class EloquentPageCategoryRepository implements PageCategoryRepository
{
    /**
     * Returns all instances of PageCategory.
     * @return PageCategory
     */
    public function all()
    {
        return PageCategory::all();
    }

    /**
     * Find the specified PageCategory or throw an exception.
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return PageCategory::findOrFail($id);
    }

    /**
     * Creates a new instance of PageCategory.
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return PageCategory::create($data);
    }

    /**
     * Returns the PageCategory count.
     * @return mixed
     */
    public function count()
    {
        return PageCategory::count();
    }

    public function delete($id)
    {
        return PageCategory::destroy($id);
    }

    /**
     * Searches for categories that contains the term provided
     * @param $term
     * @return mixed
     */
    public function searchByTerm($term)
    {
        return PageCategory::where('name', 'LIKE', $term.'%')->get();
    }

    /**
     * Tries to find a page category by its name (Case insensitive)
     * @param $name
     * @return mixed
     */
    public function findByName($name)
    {
        return PageCategory::where('name', $name)->first();
    }
}