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
}