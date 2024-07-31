<?php

namespace App\Http\Controllers;
use App\Data\AdvertDto;
use App\Http\Requests\PaginationSortRequest;
use App\Http\Requests\StoreAdvertRequest;
use App\Repositories\Contracts\AdvertRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Контроллер для кошек
 *
 * Class CatsController
 *
 * @package App\Http\Controllers\Objects
 */
class AdvertController extends Controller
{


    public function __construct(private readonly AdvertRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PaginationSortRequest $request)
    {
        return $this->repository->getAll($request);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id): AdvertDto | null
    {
        return $this->repository->get($request, $id);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertRequest $request): JsonResponse
    {
        return $this->repository->create($request);
    }

}
