<?php
/**
 * Class CategoriesTableAustraliaRegionsArraySeeder
 */

use Delatbabel\NestedCategories\Models\Category;

/**
 * Class CategoriesTableAustraliaRegionsArraySeeder
 *
 * This is an example of a category seeder that is based on the included
 * CategoriesTableBaseArraySeeder class.  It seeds the database with a heirarchical
 * list of Australian regions.
 *
 * @link https://en.wikipedia.org/wiki/List_of_regions_of_Australia
 */
class CategoriesTableAustraliaRegionsArraySeeder extends CategoriesTableBaseListSeeder
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
}
