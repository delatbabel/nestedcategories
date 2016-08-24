<?php

/**
 * Categories model config
 *
 * @link https://github.com/ddpro/admin/blob/master/docs/model-configuration.md
 */

return array(

    'title' => 'Categories',

    'single' => 'category',

    'model' => '\Delatbabel\NestedCategories\Models\Category',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        'name' => array(
            'title' => 'Name',
        ),
        'description' => array(
            'title' => 'Description',
        ),
    ),

    /**
     * The filter set
     */
    'filters' => array(
        'name' => array(
            'title' => 'Name',
        ),
    ),

    /**
     * The editable fields
     */
    'edit_fields' => array(
        'name' => array(
            'title' => 'Name',
            'type' => 'text',
        ),
        'description' => array(
            'title' => 'Description',
            'type' => 'text',
        ),
        'parent' => array(
            'title' => 'Parent Category Name',
            'type' => 'relationship',
            'name_field' => 'name',
            'options_sort_field' => 'name',
        ),
        'extended_data' => array(
            'title' => 'Extended Data',
            'type' => 'textarea',
        ),
    ),

    'form_width' => 500,
);
