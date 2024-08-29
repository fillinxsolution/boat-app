<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function list();

    public function subList();

    public function storeOrUpdate(array $data, $id = null);


    public function findById(int $id);
}
