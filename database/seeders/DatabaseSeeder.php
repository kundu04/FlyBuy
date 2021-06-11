<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Category::create(['name'=>'laptop','slug'=>'laptop','description'=>'laptop category','img'=>'files/photo1.jpg']);
        Category::create(['name'=>'mobile phone','slug'=>'mobile-phone','description'=>'mobile phone category','img'=>'files/photo1.jpg']);

         Category::create(['name'=>'books','slug'=>'books','description'=>'bookx category','img'=>'files/photo2.jpg']);

        Subcategory::create(['name'=>'dell','category_id'=>1]);
        Subcategory::create(['name'=>'hp','category_id'=>1]);
        Subcategory::create(['name'=>'lenovo','category_id'=>1]);


        Product::create([
        	'name'=>'HP LAPTOPS ',
        	'image'=>'product/photo3.jpg',
        	'price'=> rand(700,1000),
        	'description'=>'This is the description of a product',
        	'additional_info'=>'This is additional info',
        	'category_id'=> 1,
            'subcategory_id'=>1



        ]);

        Product::create([
        	'name'=>'Dell LAPTOPS ',
        	'image'=>'product/photo4.jpg',
        	'price'=> rand(800,1000),
        	'description'=>'This is the description of a product',
        	'additional_info'=>'This is additional info',
        	'category_id'=> 1,
            'subcategory_id'=>1




        ]);

        Product::create([
        	'name'=>'LENOVO LAPTOPS ',
        	'image'=>'product/photo5.png',
        	'price'=> rand(700,1000),
        	'description'=>'This is the description of a product',
        	'additional_info'=>'This is additional info',
        	'category_id'=> 1,
            'subcategory_id'=>2



        ]);
        User::create([
        	'name'=>'LaraAdmin',
        	'email'=>'admin@gmail.com',
        	'password'=>bcrypt('password'),
        	'email_verified_at'=>NOW(),
        	'address'=>'Bangladesh',
        	'phone_number'=>'0576232',
        	'is_admin'=>1
        ]);
    }
}
