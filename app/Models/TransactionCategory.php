<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionCategory extends Model
{
    use BelongsToUser;

    protected $guarded = ['_'];

    public function subcategories(): HasMany
    {
        return $this->hasMany(TransactionSubcategory::class);
    }
}
