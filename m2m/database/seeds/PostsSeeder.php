<?php
use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $faker = Faker\Factory::create();
//        $posts = factory(App\Post::class, 300)->make();
        factory('App\Post', 500)->create();

        $postIds = Post::lists('id');
        $categoryIds = \App\Category::lists('id');
//        dd($categoryIds);
        for ($i = 0; $i < count($postIds);$i++)
        {
            DB::table('categorizables')->insert(array(
                'category_id' => rand(1, count($categoryIds)-1 ),
                'categorizable_id' => $i,
                'categorizable_type' => Post::class
            ));
        }

        Model::reguard();
    }
}