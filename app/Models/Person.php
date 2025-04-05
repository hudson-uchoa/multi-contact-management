<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar_url'
    ];

    protected static function booted()
    {
        static::creating(function ($person) {
            try {
                $response = Http::get('https://randomuser.me/api/');

                if ($response->successful()) {
                    $data = $response->json();

                    $avatarUrl = $data['results'][0]['picture']['large'];
                } else {
                    $avatarUrl = null;
                }
            } catch (\Exception $e) {
                $avatarUrl = null;
            }

            $person->avatar_url = $avatarUrl;
        });
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
