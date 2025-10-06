<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\Entities\City;
use App\Domain\Repositories\CityRepositoryInterface;
use App\Infrastructure\Persistence\Eloquent\Models\CityModel;

class EloquentCityRepository implements CityRepositoryInterface
{
    public function save(City $city): City
    {
        // Verifica se já existe uma cidade com o mesmo ibge_id
        $existingModel = CityModel::where('ibge_id', $city->getIbgeId())->first();
        
        if ($existingModel) {
            // Se já existe, atualiza apenas o nome se necessário
            if ($existingModel->ibge_name !== $city->getIbgeName()) {
                $existingModel->ibge_name = $city->getIbgeName();
                $existingModel->save();
            }
            $city->setId($existingModel->id);
            return $city;
        }

        // Se não existe, cria novo
        $model = new CityModel();
        $model->ibge_id = $city->getIbgeId();
        $model->ibge_name = $city->getIbgeName();
        $model->save();

        $city->setId($model->id);
        return $city;
    }

    public function exists(City $city): bool
    {
        if ($city->getId()) {
            return CityModel::where('id', $city->getId())->exists();
        }

        return CityModel::where('ibge_id', $city->getIbgeId())->exists();
    }

    public function findAll(): array
    {
        $models = CityModel::all();

        if ($models->isEmpty()) return [];

        return $models->map(function ($model) {
            return new City($model->id, $model->ibge_id, $model->ibge_name);
        })->toArray();
    }
}
