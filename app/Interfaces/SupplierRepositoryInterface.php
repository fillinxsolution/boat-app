<?php

namespace App\Interfaces;

interface SupplierRepositoryInterface
{
    public function list($id);

    public function storeOrUpdate(array $data, $id = null);

    public function findById($id);

    public function supplierDetail(string $id);

    public function destroyById($id);
}
