<?php

declare(strict_types=1);

namespace Modules\System\Database;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait CreatedByTrait
{
    public static function bootCreatedByTrait(): void
    {
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (! $model->isDirty('created_by')) {
                $model->created_by = auth()->user()?->id;
            }
        });
    }
}
