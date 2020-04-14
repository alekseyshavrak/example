<?php

namespace App\Http\Controllers\Practice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Practice\PracticeCategoryResource;
use App\Http\Resources\Practice\PracticeResource;
use App\Model\Practice;
use App\Model\PracticeCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ListController extends Controller
{
    /**
     * List Practices
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        return PracticeResource::collection(Practice::all());
    }


    /**
     * List Practices by Category
     *
     * @return JsonResource
     */
    public function categories(): JsonResource
    {
        return PracticeCategoryResource::collection(PracticeCategory::all());
    }
}
