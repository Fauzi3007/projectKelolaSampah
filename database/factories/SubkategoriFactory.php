<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subkategori>
 */
class SubkategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_subkategori' => $this->faker->word,
            'kategori_id_kategori' => \App\Models\Kategori::factory()->create()->id_kategori,
        ];
    }
}
