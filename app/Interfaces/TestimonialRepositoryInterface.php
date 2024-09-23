<?php

namespace App\Interfaces;

interface TestimonialRepositoryInterface
{
    public function list();

    public function activeList();

    public function isPopular();

    public function storeOrUpdate(array $data, $id = null);

    public function findById($id);

    public function destroyById($id);

}
