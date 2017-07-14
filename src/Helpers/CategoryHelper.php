<?php

namespace Delatbabel\NestedCategories\Helpers;

use Delatbabel\NestedCategories\Models\Category;
use Illuminate\Database\Schema\Builder;

/**
 * Class CategoryHelper
 *
 * I hate helper classes
 *
 * Example
 *
 * <code>
 * $list = CategoryHelper::filterCategoriesByParentSlug('contacts');
 * </code>
 *
 * @see  ...
 * @link ...
 */
class CategoryHelper
{
    /**
     * Returns a query to find subcategories of a parent category by the slug.
     *
     * @param Builder $query
     * @param string $slug
     * @return Builder
     */
    public static function filterCategoriesByParentSlug($query, $slug) {
        $obj = \Delatbabel\NestedCategories\Models\Category::where('slug', $slug)->first();
        if ($obj) {
            $query->where('parent_id', $obj->id);
        } else {
            $query->where('slug', $slug);
        }
    }

    /**
     * Returns a query to find subcategories of a parent category by the name.
     *
     * Only picks subcategories under a parent category (parent category has
     * parent_id IS NULL).
     *
     * @param Builder $query
     * @param string $slug
     * @return Builder
     */
    public static function filterCategoriesByParentName($query, $name) {
        $obj = \Delatbabel\NestedCategories\Models\Category::where('name', $name)
            ->whereNull('parent_id')
            ->first();
        if ($obj) {
            $query->where('parent_id', $obj->id);
        } else {
            $query->where('name', $name);
        }
    }
}
