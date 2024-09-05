<?php

namespace App\Repositories;

use App\Models\Review;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ReviewRepository.
 */
class ReviewRepository
{
    protected $model;

    public function __construct(Review $review)
    {
        $this->model = $review;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($request)
    {
        return $this->model->create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    }

    public function update($request, $id)
    {
        $review = $this->model;
        return $review->findOrfail($id)->update([
            'rating' => $request->rating ?? $review->rating,
            'comment' => $request->comment ?? $review->comment,
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
