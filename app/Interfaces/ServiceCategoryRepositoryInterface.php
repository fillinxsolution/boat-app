<?php

namespace App\Interfaces;

interface ServiceCategoryRepositoryInterface
{
    public function list();

    public function activeList();

    public function parentCategory();

    public function activeCategory();

    public function isPopular();

    public function storeOrUpdate(array $data, $id = null);

    public function findById($id);

    public function nestedCategory($id);

    public function destroyById($id);

    public function subCategory($id);
}
