<?php
namespace Yeoji\ParshCMS\Repositories\Interfaces;

interface RESTRepository
{
    /**
     * Returns all instances of model.
     * @return Scan
     */
    public function all();

    /**
     * Find the specified model or throw an exception.
     * @param $id
     * @return mixed
     */
    public function findOrFail($id);

    /**
     * Creates a new instance of model.
     * @param $data
     * @return mixed
     */
    public function create($data);

    /**
     * Returns the model count.
     * @return mixed
     */
    public function count();

    /**
     * Deletes the model.
     * @param $id
     * @return mixed
     */
    public function delete($id);
}