<?php

namespace App\Services;

use App\DTO\ServiceResponse;
use App\Http\Resources\CityResource;
use App\Repositories\CityRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class CityServices
{
    public function __construct(
        private CityRepositoryInterface $repo
    ) {}

    public function getCities(): ServiceResponse
    {
        try {
            $cities = $this->repo->getCities();

            return new ServiceResponse(
                success: true,
                message: 'Cities listed successfully',
                data: CityResource::collection($cities)->resolve(),
                status: 200
            );

        } catch (QueryException $e) {
            Log::error('An error occurred while fetching cities: ' . $e->getMessage());
            return new ServiceResponse(
                success: false,
                message: 'An error occurred while fetching cities',
                status: 500
            );
        }
    }
}