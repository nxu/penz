<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\SortableTrait;

class TransactionCategory extends Model
{
    use BelongsToUser;
    use SortableTrait;

    protected $guarded = ['_'];

    protected static function booted()
    {
        self::creating(fn (self $model) => $model->user_id = auth()->id());
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(TransactionSubcategory::class);
    }
}
