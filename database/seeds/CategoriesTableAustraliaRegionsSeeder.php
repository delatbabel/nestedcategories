<?php
/**
 * Class CategoriesTableAustraliaRegionsSeeder
 */

use Delatbabel\NestedCategories\Models\Category;

/**
 * Class CategoriesTableAustraliaRegionsSeeder
 *
 * This is an example of a category seeder that is based on the included
 * CategoriesTableBaseSeeder class.  It seeds the database with a heirarchical
 * list of Australian regions.
 *
 * @link https://en.wikipedia.org/wiki/List_of_regions_of_Australia
 */
class CategoriesTableAustraliaRegionsSeeder extends CategoriesTableBaseSeeder
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
         * Can't get this working. Does anyone else want to have a go?
         *
         * Read a text file in markdown nested list syntax and return a
         * nested array.
         *
        $load_file = __DIR__ . '/examples/australia-regions.txt';
        $load_data = file($load_file);

        $sample_array = ['Australia' => []];
        Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
            'sample_array = ', $sample_array);

        // $parent is an array of references into the $result array.
        $parent = array();
        $result = array();
        $result_count = 0;

        foreach ($load_data as $load_record) {
            Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                $load_record);
            $match = preg_match('/^\*+/', $load_record, $matches);

            // If there is no match then we have hit a top level category.
            // Add this to the $result array and reset the $parent array.
            if ($match === 0) {
                $text = trim($load_record);
                $result[$text] = [];
                $parent = [0 => & $result[$text]];
                Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                    'result = ', $result);
                Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                    'parent = ', $parent);
                continue;
            }

            // If there is a match then check how many levels deep we are.
            $levels = strlen($matches[0]);

            // Grab the current array at the level of the parent.
            $current = $parent[$levels - 1];

            Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'current before push = ', $current);

            // Push the item onto the end of the array as item => []
            $current[] = [trim(substr($load_record, $levels)) => []];
            $count = count($current);

            Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'current after push = ', $current);

            // Put the array back into $result
            // $result[$parent[$levels - 1]] = $current;
            $parent[$levels-1] = $current;
            $parent[$levels] = & $current[$count-1];

            Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'result = ', $result);
            Log::debug(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'parent = ', $parent);
        }

        return $result;
         */

        return require __DIR__ . '/examples/australia-regions.php';
    }
}
