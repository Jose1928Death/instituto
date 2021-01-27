<?php

namespace Database\Factories;

use App\Models\Alumno;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alumno::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->sentence($nbWords = 4, $variableNbWords = true),

            'apellidos'=>$this->faker->sentence($nbWords = 4, $variableNbWords = true),

            'email'=>$this->faker->unique()->email,

            'telefono'=>$this->faker->optional()->phoneNumber
        ];
    }
}
