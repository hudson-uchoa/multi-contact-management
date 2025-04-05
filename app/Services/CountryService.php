<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CountryService implements CountryServiceInterface
{
    public function getCallingCodes(): array
    {
        return Cache::remember('country_calling_codes', 86400, function () {
            try {
                $url = 'https://restcountries.com/v3.1/all?fields=name,idd';

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 40);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $curlError = curl_error($ch);
                curl_close($ch);

                if ($response === false || $httpCode !== 200) {
                    throw new \Exception("cURL request failed: HTTP $httpCode - $curlError");
                }

                $json = json_decode($response, true);

                if (!is_array($json)) {
                    throw new \Exception("Invalid JSON received");
                }

                $data = collect($json)
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
                Log::error('CountryService Error: ' . $e->getMessage());
                return [];
            }
        });
    }
}
