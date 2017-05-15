<?php

namespace Delatbabel\NestedCategories\Helpers;

class CategoryHelper {
    public static function filterCategoriesByParentSlug($query, $slug) {
        $obj = \Delatbabel\NestedCategories\Models\Category::where('slug', $slug)->first();
        if ($obj) {
            $query->where('parent_id', $obj->id);
        } else {
            $query->where('slug', $slug);
        }
    }
}