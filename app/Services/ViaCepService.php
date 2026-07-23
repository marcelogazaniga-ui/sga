<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    public function search(string $cep): ?array
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);

        if (strlen($cep) !== 8) {
            return null;
        }

        $response = Http::get(
            "https://viacep.com.br/ws/{$cep}/json/"
        );

        if ($response->failed()) {
            return null;
        }

        $data = $response->json();

        if (isset($data['erro'])) {
            return null;
        }

        return [
            'address' => $data['logradouro'] ?? null,
            'district' => $data['bairro'] ?? null,
            'city' => $data['localidade'] ?? null,
            'state' => $data['uf'] ?? null,
        ];
    }
}
