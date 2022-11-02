<?php

use Faker\Generator as Faker;

function genDui()
{
    $f = true;
    do{
        $numbers = explode('|', '0|1|2|3|4|5|6|7|8|9');
        $dui = '';
        for ($i = 1; $i <= 10; $i++){
            $dui .= $i == 9 ? '-' : $numbers[rand(0, 9)];
        }

        $f = DB::table('users')->where('dui', $dui)->count() != 0;
    }while($f);
    return $dui;
}

function calcAge($birthDate)
{
    $date = new DateTime($birthDate);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->y;
}

$factory->define(\Ignite\User::class, function (Faker $faker) {
    $bday = $faker->date('Y-m-d', '1998-12-31');
    return [
        'dui' => genDui(),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'name' => $faker->name,
        'lastname' => $faker->name,
        'birthdate' => $bday,
        'age' => calcAge($bday),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'user_type_id' => 'ASI',
//        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
