<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductComment;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    Article::factory()->count(20)->create();
    Category::factory()->count(5)->create();
    Comment::factory()->count(40)->create();

    User::factory()->create([
        "name" => "Alice",
        "email" => "alice@gmail.com",
    ]);
    User::factory()->create([
        "name" => "Bob",
        "email" => "bob@gmail.com",
    ]); 

    Product::factory()->count(15)->create();
    ProductComment::factory()->count(25)->create();
  }
}
