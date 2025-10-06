<?php

namespace App\Infrastructure\Http\Clients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IbgeApiClient
{
    private const IBGE_BASE_URL = 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/33/municipios';

    /**
     * Busca todas as cidades do Rio de Janeiro
     * 
     * @return array
     * @throws \Exception
     */
    public function getCitiesFromRioDeJaneiro(): array
    {
        try {
            $response = Http::timeout(30)->get(self::IBGE_BASE_URL);
            
            if (!$response->successful()) {
                throw new \Exception('Erro ao consultar API do IBGE: ' . $response->status());
            }

            $data = $response->json();
            
            if (!is_array($data)) {
                throw new \Exception('Resposta inválida da API do IBGE');
            }

            return $data;
            
        } catch (\Exception $e) {
            Log::error('Erro ao consultar API do IBGE: ' . $e->getMessage());
            throw new \Exception('Falha na comunicação com a API do IBGE: ' . $e->getMessage());
        }
    }
}
