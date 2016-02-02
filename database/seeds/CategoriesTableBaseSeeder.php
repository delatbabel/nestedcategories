<?php

use Delatbabel\NestedCategories\Models\Category;

class CategoriesTableBaseSeeder extends \Seeder
{

    public function run()
    {
        DB::table('categories')->delete();

        /**
         * The types of categories in your site, e.g. Products, Blog etc.
         *
         * Replace this with whatever you want in your initial seeder.
         */
        $types = array(
            'Blog' => array(
                // There will probably be more configuration options in here
                // in the future, when I add methods to render a
                // a tree in HTML for example.
            ),
        );

        $roots = array_keys($types);
        foreach ($roots as $root) {
            Category::create(array(
                'name' => $root,
            ));
        }
    }
}
