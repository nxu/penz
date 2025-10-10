<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;

class TransactionPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Transaction $transaction): bool
    {
        return $transaction->user_id = $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Transaction $transaction): bool
    {
        return $transaction->user_id = $user->id;
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $transaction->user_id = $user->id;
    }

    public function restore(User $user, Transaction $transaction): bool
    {
        return $transaction->user_id = $user->id;
    }

    public function forceDelete(User $user, Transaction $transaction): bool
    {
        return $transaction->user_id = $user->id;
    }
}
