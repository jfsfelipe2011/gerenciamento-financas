<?php

use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {   
        /* @var \Jfin\Application $app */
        $app = require __DIR__ . '/../bootstrap.php';
        $auth = $app->service('auth');

        $faker = \Faker\Factory::create('pt_BR');

        $users = $this->table('users');

        $data = [];

        $users->insert([
            'first_name' => $faker->firstName,
            'last_name'  => $faker->lastName,
            'email'      => 'admin@user.com',
            'password'   => $auth->hashPassword('12345'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ])->save();

        foreach (range(1, 3) as $value) {
            $data[] = [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->email,
                'password'   => $auth->hashPassword('54321'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        $users->insert($data)->save();
    }
}
