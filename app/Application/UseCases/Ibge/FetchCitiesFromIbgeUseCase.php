<?php

namespace App\Application\UseCases\Ibge;

use App\Domain\Entities\City;
use App\Domain\Repositories\CityRepositoryInterface;
use App\Infrastructure\Http\Clients\IbgeApiClient;

class FetchCitiesFromIbgeUseCase
{
    private CityRepositoryInterface $repo;
    private IbgeApiClient $ibgeClient;

    public function __construct(CityRepositoryInterface $repo, IbgeApiClient $ibgeClient)
    {
        $this->repo = $repo;
        $this->ibgeClient = $ibgeClient;
    }

    /**
     * Busca municípios do Rio de Janeiro na API do IBGE,
     * salva no banco apenas os que ainda não existem,
     * e retorna as cidades salvas.
     */
    public function execute(): array
    {
        // Busca cidades do RJ na API do IBGE
        $citiesData = $this->ibgeClient->getCitiesFromRioDeJaneiro();
        $savedCities = [];

        foreach ($citiesData as $cityData) {
            // Cria a entidade City
            $city = new City(
                null, // id do banco será gerado automaticamente
                $cityData['id'], // ibge_id
                $cityData['nome'] // ibge_name
            );

            // Salva no banco (o repositório já previne duplicatas)
            $savedCity = $this->repo->save($city);
            $savedCities[] = $savedCity;
        }

        return $savedCities;
    }
}
