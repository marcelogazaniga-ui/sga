<?php

namespace App\Services\Address;

use Illuminate\Support\Facades\Http;

class ViaCepService
{

    /**
     * Busca endereço pelo CEP
     */
    public function find(string $cep): ?array
    {

        $cep = preg_replace('/[^0-9]/', '', $cep);


        if (strlen($cep) !== 8) {

            return null;

        }


        $response = Http::timeout(5)
            ->get(
                "https://viacep.com.br/ws/{$cep}/json/"
            );


        if (!$response->successful()) {

            return null;

        }


        $data = $response->json();


        if (isset($data['erro'])) {

            return null;

        }


        return [

            'zip_code' => $cep,

            'address' =>
                $data['logradouro'] ?? null,


            'district' =>
                $data['bairro'] ?? null,


            'city' =>
                $data['localidade'] ?? null,


            'state' =>
                $data['uf'] ?? null,


        ];

    }

}
