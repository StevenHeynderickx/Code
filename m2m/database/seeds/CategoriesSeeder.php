<?php
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $faker = Faker\Factory::create();
        Category::create(
            [
                'id' => 1,
                'name' => 'Parent Category',
                'parent_id' => 0
            ]
        );

        for($i=0; $i<10;$i++)
        {
            Category::create(
                [
                    'name' => $faker->colorName,
                    'parent_id' => 1
                ]
            );
        }

        Model::reguard();
    }
}