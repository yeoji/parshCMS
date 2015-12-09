<?php
namespace Yeoji\ParshCMS\Repositories\Interfaces;

interface ThemeRepository
{
    /**
     * Returns all instances of Theme.
     * @return Scan
     */
    public function all();

    /**
     * Find the specified Theme or throw an exception.
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Creates a new instance of Theme.
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * Returns the Theme count.
     * @return mixed
     */
    public function count();

    /**
     * Deletes the Theme.
     * @param $id
     * @return mixed
     */
    public function delete($id);
}