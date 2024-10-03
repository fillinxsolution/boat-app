<?php

namespace App\Interfaces;

interface ServiceRepositoryInterface
{
    public function list($id);


    public function serviceByCategory($id);

    public function serviceByCategoryFilter($id);

    public function servicesList();

    public function limitServices();

    public function activeList($id);

    public function storeOrUpdate(array $data, $id = null);

    public function findById($id);

    public function destroyById($id);
}
