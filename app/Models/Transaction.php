<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use BelongsToUser;

    protected $guarded = ['_'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(TransactionSubcategory::class);
    }
}
