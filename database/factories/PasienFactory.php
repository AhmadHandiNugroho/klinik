<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pasien;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pasien>
 */
class PasienFactory extends Factory
{
    protected $model = Pasien::class;

    public function definition(): array
    {
        return [
            'no_pasien' => $this->faker->unique()->randomNumber(5),
            'nama' => $this->faker->name(),
            'umur' => $this->faker->numberBetween(20, 70),
            'jenis_kelamin' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'alamat' => $this->faker->address(),
        ];
    }
}
