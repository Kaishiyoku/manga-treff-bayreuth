<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * The field name for generating slugs
     *
     * @return string
     */
    public function getSlugValueFieldName()
    {
        return $this->slugValueFieldName ?? 'name';
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(function (self $model) {
            $model->slug = $model->getAttribute($model->primaryKey) . '-' . Str::slug($model->getAttribute($model->getSlugValueFieldName()));

            return $model;
        });
    }
}
