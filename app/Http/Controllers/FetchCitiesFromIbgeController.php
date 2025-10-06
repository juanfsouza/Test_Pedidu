<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Ibge\FetchCitiesFromIbgeUseCase;
use App\Application\DTOs\CityResponseDTO;

class FetchCitiesFromIbgeController
{
    public function __construct(private FetchCitiesFromIbgeUseCase $useCase) {}
    
    public function execute()
    {
        try {
            $cities = $this->useCase->execute();
            $responseDTOs = array_map(function($city) {
                return [
                    'id' => $city->getId(),
                    'ibge_id' => $city->getIbgeId(),
                    'ibge_name' => $city->getIbgeName()
                ];
            }, $cities);
            
            return response()->json($responseDTOs);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao buscar cidades do IBGE',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
