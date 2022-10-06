<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "ste";
        $user->email = "pino@gmail.it";
        $user->password = bcrypt("12345678");

        $user->save();
    }
}
