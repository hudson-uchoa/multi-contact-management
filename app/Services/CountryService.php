<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Log;

class CountryService implements CountryServiceInterface
{
    public function getCallingCodes(): array
    {
        return Cache::remember('country_calling_codes', 86400, function () {
            try {
                $response = Http::timeout(10)
                    ->withoutVerifying()
                    ->get('https://restcountries.com/v3.1/all?fields=name,idd');

                if (!$response->successful()) {
                    throw new \Exception('Request failed with status: ' . $response->status());
                }

                $data = collect($response->json())
                    ->filter(fn($c) => isset($c['idd']['root'], $c['idd']['suffixes']) && !empty($c['idd']['suffixes']))
                    ->map(function ($country) {
                        return [
                            'name' => $country['name']['common'] ?? '',
                            'code' => $country['idd']['root'] . $country['idd']['suffixes'][0],
                        ];
                    })
                    ->filter(fn($c) => !empty($c['name']) && !empty($c['code']))
                    ->sortBy('name')
                    ->values()
                    ->toArray();

                if (empty($data)) {
                    throw new \Exception('No valid data received.');
                }

                return $data;

            } catch (\Exception $e) {
                Log::error($e->getMessage());
                return [];
            }
        });
    }
}
