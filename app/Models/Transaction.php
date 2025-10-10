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
        return $this->belongsTo(TransactionCategory::class, 'transaction_category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(TransactionSubcategory::class, 'transaction_subcategory_id');
    }
}
