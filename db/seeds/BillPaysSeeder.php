<?php

use Faker\Provider\Base;
use JFin\Models\CategoryCost;
use Phinx\Seed\AbstractSeed;

class BillPaysSeeder extends AbstractSeed
{
    /**
     * [collection de categorias]
     * @var Illuminate\Database\Eloquent\Collection
     */
    private $categories;
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
        require __DIR__ . '/../bootstrap.php';

        $faker = \Faker\Factory::create('pt_BR');
        $faker->addProvider($this);

        $billPays = $this->table('bill_pays');

        $data = [];
        $this->categories = CategoryCost::all();

        foreach (range(1, 20) as $value) {
            $userId = rand(1,4);

            $data[] = [
                'date_lauch'        => $faker->date(),
                'name'              => $faker->word,
                'value'             => $faker->randomFloat(2, 10, 1000),
                'user_id'           => $userId,
                'category_cost_id'  => $faker->categoryId($userId),
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ];
        }

        $billPays->insert($data)->save();
    }

    public function categoryId($userId)
    {
        $categories = $this->categories->where('user_id', $userId);
        $categories = $categories->pluck('id');

        return Base::randomElement($categories->toArray());
    }
}
