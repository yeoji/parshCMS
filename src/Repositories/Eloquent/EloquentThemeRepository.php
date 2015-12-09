<?php
namespace Yeoji\ParshCMS\Repositories\Eloquent;

use Yeoji\ParshCMS\Models\Eloquent\Theme;
use Yeoji\ParshCMS\Repositories\Interfaces\ThemeRepository;

class EloquentThemeRepository implements ThemeRepository
{
    /**
     * Returns all instances of Theme.
     * @return Theme
     */
    public function all()
    {
        return Theme::all();
    }

    /**
     * Find the specified Theme or throw an exception.
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return Theme::findOrFail($id);
    }

    /**
     * Creates a new instance of Theme.
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return Theme::create($data);
    }

    /**
     * Returns the Theme count.
     * @return mixed
     */
    public function count()
    {
        return Theme::count();
    }

    /**
     * Deletes the Theme.
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return Theme::destroy($id);
    }
}