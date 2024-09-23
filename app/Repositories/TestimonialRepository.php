<?php

namespace App\Repositories;

use App\Interfaces\TestimonialRepositoryInterface;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;


class TestimonialRepository implements TestimonialRepositoryInterface
{

    /**
     * All  Testimonial list.
     */
    public function list(): Collection
    {
        return Testimonial::latest()->get();
    }

     /**
     * Active  Testimonial list.
     */
    public function activeList(): Collection
    {
        return Testimonial::where('status', 'Active')->get();
    }

    /**
     * Popular  Testimonial list.
     */
    public function isPopular(): Collection
    {
        return Testimonial::where('is_featured','Yes')->where('status', 'Active')->get();
    }

    /**
     * Create & save  Testimonial.
     */
    public function storeOrUpdate(array $data, $id = null): Testimonial
    {
        $cat = Testimonial::updateOrCreate(
            ['id' => $id],
            $data
        );
        return $cat;
    }

    /**
     * Find  Testimonial by id.
     */
    public function findById($id): Testimonial
    {
        return Testimonial::find($id);
    }


    /**
     * Delete Testimonial by id.
     */
    public function destroyById($id): bool
    {
        return $this->findById($id)->delete();
    }
}
