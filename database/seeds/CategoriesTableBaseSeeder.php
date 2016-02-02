<?php

use Delatbabel\NestedCategories\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableBaseSeeder extends Seeder
{

    /**
     * @param Category $root_node
     * @param array $nodes
     */
    protected function createNodes($root_node, $nodes)
    {
        foreach ($nodes as $node_name => $node_children) {

            $child_node = $root_node->children()->create([
                'name' => $node_name
            ]);

            if (! empty($node_children)) {
                $this->createNodes($child_node, $node_children);
            }
        }

    }

    public function run()
    {
        DB::table('categories')->delete();

        /**
         * The types of categories in your site, e.g. Products, Blog etc.
         *
         * Replace this with whatever you want in your initial seeder.
         */
        $nodes = [
            'Blog' => [
                'Politics'  => [],
                'Fashion'   => [],
                'Sailing'   => [],
                'Technical'   => [],
            ],
            'Products' => [
                'Flowers'   => [
                    'Roses'     => [],
                    'Geraniums' => [],
                    'Lillies'      => [],
                ],
                'Games'     => [
                    'Board Games'   => [
                        'Strategy_Games'    => [],
                        'Euro Games'        => [],
                    ],
                    'Computer Games' => [
                        'FPS'                   => [],
                        'Real Time Strategy'    => [],
                        'War Games'             => [],
                    ],
                ],
            ],
        ];

        // Build the above list of nodes as a heirarchical tree
        // of categories.
        foreach ($nodes as $node_name => $node_children) {

            // Create each root node.
            $root_node = Category::create([
                'name' => $node_name,
            ]);

            // Create the children of the root node.
            $this->createNodes($root_node, $node_children);
        }

    }
}
