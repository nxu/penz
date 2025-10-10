<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\EloquentSortable\SortableTrait;

class TransactionSubcategory extends Model
{
    use BelongsToUser;
    use SortableTrait;

    protected $guarded = ['_'];

    protected static function booted()
    {
        self::creating(fn (self $model) => $model->user_id = auth()->id());
    }

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class, 'transaction_category_id');
    }
}
