<?php

namespace Delatbabel\NestedCategories\Helpers;

class CategoryHelper {
    public static function filterCategoriesByParentSlug($query, $slug) {
        $query->where(
            'parent_id', \Delatbabel\NestedCategories\Models\Category::where('slug', $slug)->first()->id
        );
    }
}