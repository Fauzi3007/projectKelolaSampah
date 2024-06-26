<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mitra>
 */
class PenggunaSaranaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pengguna' => $this->faker->name('id_ID'),
            'no_hp' => $this->faker->phoneNumber('id_ID'),
            'id_akun' => 1,
        ];
    }
}
