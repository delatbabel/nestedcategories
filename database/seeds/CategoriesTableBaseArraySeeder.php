<?php
/**
 * Class CategoriesTableBaseArraySeeder
 */
use Delatbabel\NestedCategories\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Class CategoriesTableBaseArraySeeder
 *
 * This is an example class to seed the Categories table from an array.
 *
 * See the getNodes() function for the array structure.
 */
class CategoriesTableBaseArraySeeder extends Seeder
{
    /**
     * Return an array of nodes.
     *
     * Over-ride this function in your real seeder class.
     *
     * @return array
     */
    protected function getNodes()
    {
        /**
         * The types of categories in your site, e.g. Products, Blog etc.
         *
         * Replace this with whatever you want in your initial seeder.  Note
         * the structure of each node -- node_name => children where children
         * must be an array.
         */
        return [
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
    }

    /**
     * Create all of the child nodes of a root node.
     *
     * @param Category $root_node
     * @param array $nodes
     */
    protected function createNodes($root_node, $nodes)
    {
        foreach ($nodes as $node_name => $node_children) {

            // Create the highest level child node.
            $child_node = $root_node->children()->create([
                'name' => $node_name
            ]);

            // Update the description, just for fun
            $child_node->description = $child_node->path;
            $child_node->save();

            // Create all of the children of the child node, if there are any.
            if (! empty($node_children)) {
                $this->createNodes($child_node, $node_children);
            }
        }

    }

    public function run()
    {
        $nodes = $this->getNodes();

        // Build the above list of nodes as a heirarchical tree
        // of categories.
        foreach ($nodes as $node_name => $node_children) {

            // Create each root node.
            $root_node = Category::create([
                'name' => $node_name,
            ]);

            // Create the children of the root node.
            if (! empty($node_children)) {
                $this->createNodes($root_node, $node_children);
            }
        }
    }
}
