<?php
/**
 * Class CategoriesTableBaseListSeeder
 */

use Delatbabel\NestedCategories\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Class CategoriesTableBaseListSeeder
 *
 * This is a sample class to seed the categories table from a markdown/wiki
 * style structured list.
 *
 * ### Example
 *
 * Create a file containing a list like this:
 *
 * <code>
 * Australia
 * * New South Wales
 * ** Sydney
 * ** Newcastle
 * * Victoria
 * ** Melbourne
 * </code>
 *
 * Create a sub-class of this class containing a getNodes() function.  This should
 * read the contents of the file into an array.  Alternatively if the list data is
 * coming from somewhere else (e.g. an API) then fetch the list of nodes.
 */
class CategoriesTableBaseListSeeder extends Seeder
{
    /**
     * Return a list.
     *
     * Over-ride this function in your real seeder class.
     *
     * @return array
     */
    protected function getNodes()
    {
        /**
         * Get the file contents.
         *
         * Read a text file in markdown nested list syntax and return an array
         * containing the file contents.
         */
        $load_file = __DIR__ . '/examples/australia-regions.txt';
        $load_data = file($load_file);

        return $load_data;
    }

    /**
     * Create all of the child nodes of a root node.
     *
     * @param array $nodes
     */
    protected function createNodes($nodes)
    {
        // $parent is the array of parent nodes.
        $parent = array();

        foreach ($nodes as $load_record) {
            $match = preg_match('/^\*+/', $load_record, $matches);

            // If there is no match then we have hit a top level category.
            // Add this to the $result array and reset the $parent array.
            if ($match === 0) {
                $node_name = trim($load_record);
                $root_node = Category::create([
                    'name'          => $node_name,
                    'description'   => $node_name,
                ]);

                $parent = [
                    0   => $root_node,
                ];
                continue;
            }

            // If there is a match then check how many levels deep we are.
            $levels = strlen($matches[0]);

            // Grab the node name
            $node_name = trim(substr($load_record, $levels));

            // Grab the current node at the level of the parent.
            /** @var Category $current */
            $current = $parent[$levels - 1];

            // Add this node as a child of the parent.
            $child_node = $current->children()->create([
                'name' => $node_name
            ]);

            // Update the description, just for fun
            $child_node->description = $child_node->path;
            $child_node->save();

            // Store this node name as a potential future parent.
            $parent[$levels] = $child_node;
        }
    }

    public function run()
    {
        $nodes = $this->getNodes();

        // Build the above list of nodes as a heirarchical tree
        // of categories.
        $this->createNodes($nodes);
    }
}
