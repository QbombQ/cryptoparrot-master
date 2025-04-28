<?php

use Illuminate\Database\Seeder;

class ArticleArticleCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'article_id' => 1,
                'article_category_id' => 1
            ],
            [
                'article_id' => 2,
                'article_category_id' => 1
            ],
            [
                'article_id' => 3,
                'article_category_id' => 1
            ],
            [
                'article_id' => 4,
                'article_category_id' => 1
            ],
            [  
                'article_id' => 5,
                'article_category_id' => 1
            ],  
            [
                'article_id' => 6,
                'article_category_id' => 1
            ],      
            [
                'article_id' => 7,
                'article_category_id' => 1
            ],    
            [
                'article_id' => 8,
                'article_category_id' => 1
            ],    
            [
                'article_id' => 9,
                'article_category_id' => 3
            ],                                                                                    
        ];
        foreach($categories as $category) {
            DB::table('article_article_categories')->insert($category);
        }        
    }
}
