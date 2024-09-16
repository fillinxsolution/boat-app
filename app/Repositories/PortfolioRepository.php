<?php

namespace App\Repositories;

use App\Interfaces\PortfolioRepositoryInterface;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Collection;


class PortfolioRepository implements PortfolioRepositoryInterface
{

    /**
     *  list.
     */
    public function list($id):Collection
    {
        $portfolio =  Portfolio::with(['images'])->where('supplier_id',$id)->get();
        return $portfolio;
    }

    /**
     * Active list.
     */
    public function activeList($id):Collection
    {
        $portfolio =  Portfolio::with(['images'])->where('supplier_id',$id)->where('status','Active')->get();
        return $portfolio;
    }

    /**
     * Create & save Service.
     */
    public function storeOrUpdate(array $data, $id = null): Portfolio
    {
        $portfolio = Portfolio::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $portfolio;
    }

    /**
     * Find Service by id.
     */
    public function findById($id): Portfolio
    {
        return Portfolio::find($id);
    }
    /**
     * Delete Service by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
