<?php

namespace App\Repositories\Contracts;

use App\Data\AdvertDto;
use App\Http\Requests\PaginationSortRequest;
use App\Http\Requests\StoreAdvertRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface AdvertRepository
{

    public function getAll(PaginationSortRequest $request);

    public function get(Request $request, int $id): AdvertDto | null;

    public function create(StoreAdvertRequest $request): JsonResponse;


}
