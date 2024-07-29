<?php

namespace Database\Factories;

use App\Models\AdDomain;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdDomain>
 */
class AdDomainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = AdDomain::class;

    public function definition()
    {
        return [
            "domains" => json_encode([$this->faker->domainName]),
        ];
    }
}
