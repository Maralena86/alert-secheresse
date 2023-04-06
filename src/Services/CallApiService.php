<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;
        
    function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function getFranceData(): array
    {
        $response = $this->client->request(
            'GET',
            'https://geo.api.gouv.fr/departements/91/communes'
        );
        return $response->toArray();
    }
}
