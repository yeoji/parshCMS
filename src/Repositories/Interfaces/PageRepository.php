<?php
namespace Yeoji\ParshCMS\Repositories\Interfaces;

interface PageRepository extends RESTRepository
{
    /**
     * Finds the Page model with the specified key
     * @param $key
     * @return mixed
     */
    public function findByKey($key);

    /**
     * Returns all the pages, grouped by categories if it belongs to any.
     * @return mixed
     */
    public function getGroupedPages();
}