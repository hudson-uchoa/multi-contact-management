<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CountryService implements CountryServiceInterface
{
    public function getCallingCodes(): array
    {
        return Cache::remember('country_calling_codes', 86400, function () {
            try {
                $url = 'https://restcountries.com/v3.1/all?fields=name,idd';

                $response = Http::timeout(40)->get($url);

                if (!$response->ok()) {
                    throw new \Exception("Request failed with status {$response->status()}");
                }

                $json = $response->json();

                if (!is_array($json)) {
                    throw new \Exception("Invalid JSON received");
                }

                $data = collect($json)
                    ->filter(fn($c) => isset($c['idd']['root'], $c['idd']['suffixes']) && !empty($c['idd']['suffixes']))
                    ->map(fn($country) => [
                        'name' => $country['name']['common'] ?? '',
                        'code' => $country['idd']['root'] . $country['idd']['suffixes'][0],
                    ])
                    ->filter(fn($c) => !empty($c['name']) && !empty($c['code']))
                    ->sortBy('name')
                    ->values()
                    ->toArray();

                if (empty($data)) {
                    throw new \Exception('No valid data received.');
                }

                return $data;

            } catch (\Exception $e) {
                Log::error('CountryService Error: ' . $e->getMessage());

                $fallback = storage_path('app/countries.json');
                if (file_exists($fallback)) {
                    $json = json_decode(file_get_contents($fallback), true);

                    return collect($json)
                        ->filter(fn($c) => isset($c['idd']['root'], $c['idd']['suffixes']) && !empty($c['idd']['suffixes']))
                        ->map(fn($country) => [
                            'name' => $country['name']['common'] ?? '',
                            'code' => $country['idd']['root'] . $country['idd']['suffixes'][0],
                        ])
                        ->filter(fn($c) => !empty($c['name']) && !empty($c['code']))
                        ->sortBy('name')
                        ->values()
                        ->toArray();
                }

                return [];
            }
        });
    }
}
