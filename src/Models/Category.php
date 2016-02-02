<?php
/**
 * Category
 */
namespace Delatbabel\NestedCategories\Models;

use Baum\Node;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Category
 *
 * A Laravel 5 package for adding one or more types of category hierarchy to a website.
 *
 * e.g. a hierarchy for blog categories and another for product categories
 *
 * This is a Laravel 5 reimplementation of
 * [Laravel 4 Categories](https://github.com/FbF/Laravel-Categories)
 *
 * @link https://github.com/delatbabel/nestedcategories
 */
class Category extends Node implements SluggableInterface
{
    use SluggableTrait;

    /**
     * Status values for the database
     */
    const DRAFT     = 'DRAFT';
    const APPROVED  = 'APPROVED';

    /**
     * Used for Cviebrock/EloquentSluggable
     * @var array
     */
    public static $sluggable = array(
        'build_from'         => 'name',
        'save_to'            => 'slug',
        'max_length'         => 255,
        'unique'             => true,
        'include_trashed'    => true,
    );

    /**
     * Stores the old parent id before editing
     * @var integer
     */
    protected $oldParentId = null;

    protected $casts = [
        'extended_data'     => 'array',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($category) {

            // Baum triggers a parent move, which puts the item last in the list,
            // even if the old and new parents are the same
            if ($category->isParentIdSame()) {
                $category->stopBaumParentMove();
            }

        });
    }

    /**
	 * Check for dirty parent ID.
	 *
	 * Returns true if the parent_id value in the database is different to the current
	 * value in the model's dirty attributes
	 *
	 * @return bool
     */
    protected function isParentIdSame()
    {
        $dirty = $this->getDirty();
        $oldNavItem = self::where('id', '=', $this->id)->first();
        $oldParent = $oldNavItem->parent;
        $oldParentId = $oldParent->id;
        $isParentColumnSet = isset($dirty[$this->getParentColumnName()]);
        if ($isParentColumnSet) {
            $isNewParentSameAsOld = $dirty[$this->getParentColumnName()] == $oldParentId;
        } else {
            $isNewParentSameAsOld = false;
        }
        return $isParentColumnSet && $isNewParentSameAsOld;
    }

    /**
	 * Reset parent ID.
	 *
	 * Removes the parent_id field from the model's attributes and sets $moveToNewParentId
	 * static property on the parent Baum\Node model class to false to prevent Baum from
	 * triggering a move. This can be required because Baum triggers a parent move, which
	 * puts the item last in the list, even if the old and new parents are the same.
	 *
	 * @return void
     */
    protected function stopBaumParentMove()
    {
        unset($this->{$this->getParentColumnName()});
        static::$moveToNewParentId = false;
    }

    /**
     * Adds a query scope to add conditions to query object
     *
     * @param $query
     * @return mixed
     */
    public function scopeLive($query)
    {
        return $query->where('status', '=', self::APPROVED)
            ->where('published_date', '<=', \Carbon\Carbon::now());
    }

    /**
     * Get path attribute.
     *
     * Accessor for path attribute, which is a string consisting of the ancestors
     * of each node, separated by " > ".
     *
     * @return string
     */
    public function getPathAttribute()
    {
        $ancestors = $this->getAncestors();
        $return = array();
        foreach ($ancestors as $ancestor) {
            $return[] = $ancestor->name;
        }
        $return[] = $this->name;
        return implode(' > ', $return);
    }
}
