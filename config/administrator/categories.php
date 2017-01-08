<?php

/**
 * Categories model config
 *
 * @link https://github.com/ddpro/admin/blob/master/docs/model-configuration.md
 */

return [

    'title' => 'Categories',

    'single' => 'category',

    'model'       => '\Delatbabel\NestedCategories\Models\Category',

    /**
     * The display columns
     */
    'columns'     => [
        'id'   => [
            'title' => 'ID',
        ],
        'name'        => [
            'title' => 'Name',
        ],
        'description' => [
            'title' => 'Description',
        ],
    ],

    /**
     * The filter set
     */
    'filters'     => [
        'name' => [
            'title' => 'Name',
        ],
    ],

    /**
     * The editable fields
     */
    'edit_fields' => [
        'name'          => [
            'title' => 'Name',
            'type'  => 'text',
        ],
        'description'   => [
            'title' => 'Description',
            'type'  => 'text',
        ],
        'parent'        => [
            'title'              => 'Parent Category Name',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'options_sort_field' => 'name',
        ],
        'extended_data' => [
            'title'  => 'Extended Data',
            'type'   => 'json',
            'height' => '400',
        ],
    ],

    'form_width' => 500,
];
