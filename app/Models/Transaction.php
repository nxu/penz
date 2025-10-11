<?php

namespace App\Models;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use BelongsToUser;

    protected $guarded = ['_'];

    protected static function booted()
    {
        self::creating(function (self $transaction) {
            if (empty($transaction->user_id) && Filament::auth()->check()) {
                $transaction->user_id = Filament::auth()->id();
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TransactionCategory::class, 'transaction_category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(TransactionSubcategory::class, 'transaction_subcategory_id');
    }
}
