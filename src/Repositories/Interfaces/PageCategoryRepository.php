<?php
namespace Yeoji\ParshCMS\Repositories\Interfaces;

interface PageCategoryRepository extends RESTRepository
{
    /**
     * Searches for categories that contains the term provided
     * @param $term
     * @return mixed
     */
    public function searchByTerm($term);

    /**
     * Tries to find a page category by its name (Case insensitive)
     * @param $name
     * @return mixed
     */
    public function findByName($name);
}