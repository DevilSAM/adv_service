<?php

namespace App\Repositories;

use App\Data\AdvertDto;
use App\Http\Requests\PaginationSortRequest;
use App\Http\Requests\StoreAdvertRequest;
use App\Http\Resources\AdvertResource;
use App\Models\Advert;
use App\Repositories\Contracts\AdvertRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class EloquentAdvertRepository implements AdvertRepository
{

    public function getAll(PaginationSortRequest $request)
    {
        $builder = Advert::filter($request->all());
        $sortColumn = $request->input('sort_column') ?? 'id';
        $sortDirection = $request->input('sort_direction') ?? 'ASC';
        $items = $builder
            ->orderByRaw($sortColumn . ' ' . $sortDirection)
            ->paginate(perPage: $request->validated('perPage', $labelsSettingsDto?->per_page ?? 10),
                page: $request->validated('page', 1)
            );
        return AdvertResource::collection($items);
    }

    /**
     * @throws Exception
     */
    public function get(Request $request, int $id): AdvertDto | null
    {
        $model = Advert::find($id);
        if ($request->input('fields')) {
            foreach ($request->input('fields') as $field) {
                $model->setAttribute("add_$field", 'значение нового поля');
            }
        }
        return AdvertDto::fromModel($model);
    }

    /**
     * @throws Exception
     */
    public function create(StoreAdvertRequest $request): JsonResponse
    {
        try {
            $advert = new Advert();
            $advert->fill($request->all());
            $advert->save();
            return Response::json(['id' => $advert->id], HttpFoundationResponse::HTTP_CREATED);

        } catch (Exception $e) {
            return Response::json([
                'id' => null,
                'error_code' => $e->getCode(),
                'error_message' => $e->getMessage()
            ], HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
