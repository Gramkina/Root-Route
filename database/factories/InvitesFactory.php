<?php

namespace Database\Factories;

use App\Models\Invites;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvitesFactory extends Factory{

    protected $model = Invites::class;

    public function definition(){
        return [
            'user' => 1,
            'code' => $this->faker->uuid,
            'status' => 0,
        ];
    }
}
