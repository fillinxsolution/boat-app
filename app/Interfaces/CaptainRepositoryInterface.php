<?php

namespace App\Interfaces;

interface CaptainRepositoryInterface
{
    public function list($id);

    public function lists();

    public function storeOrUpdate(array $data, $id = null);

    public function findById($id);

    public function captainDetail(string $id);

    public function destroyById($id);
}
