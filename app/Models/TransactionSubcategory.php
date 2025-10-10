<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionSubcategory extends Model
{
    use BelongsToUser;

    protected $guarded = ['_'];

    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }
}
