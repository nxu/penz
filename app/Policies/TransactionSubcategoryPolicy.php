<?php

namespace App\Policies;

use App\Models\TransactionSubcategory;
use App\Models\User;

class TransactionSubcategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, TransactionSubcategory $transactionSubcategory): bool
    {
        return $transactionSubcategory->user_id = $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, TransactionSubcategory $transactionSubcategory): bool
    {
        return $transactionSubcategory->user_id = $user->id;
    }

    public function delete(User $user, TransactionSubcategory $transactionSubcategory): bool
    {
        return $transactionSubcategory->user_id = $user->id;
    }

    public function restore(User $user, TransactionSubcategory $transactionSubcategory): bool
    {
        return $transactionSubcategory->user_id = $user->id;
    }

    public function forceDelete(User $user, TransactionSubcategory $transactionSubcategory): bool
    {
        return $transactionSubcategory->user_id = $user->id;
    }
}
