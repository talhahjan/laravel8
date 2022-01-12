<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::create([
            'title' => 'Men',
            'slug'=>trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'men')),
        ]);

        $category = Category::create([
            'title' => 'Women',
            'slug'=>trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'women')),
        ]);

        $category = Category::create([
            'title' => 'Boys',
            'slug'=>trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'boys')),
        ]);

        $category = Category::create([
            'title' => 'Girls',
            'slug'=>trim(preg_replace('/[^A-Za-z0-9-]+/', '-', 'girls')),
        ]);



    }
}
