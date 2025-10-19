<?php

namespace App\Http\Controllers;

use App\Models\TransactionCategory;
use App\Models\TransactionSubcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EntryController
{
    public function form(User $user): Response
    {
        $categories = $user->categories()
            ->with(['subcategories' => fn ($q) => $q->orderBy('order_column')])
            ->orderBy('order_column')
            ->get()
            ->map(fn (TransactionCategory $category) => [
                'id' => $category->getKey(),
                'title' => $category->title,
                'subcategories' => $category->subcategories
                    ->map(fn (TransactionSubcategory $sub) => [
                        'id' => $sub->getKey(),
                        'title' => $sub->title,
                    ])
                    ->values(),
            ])
            ->toArray();

        return response()->view('entry', compact('categories', 'user'));
    }

    public function save(User $user, Request $request): Response
    {
        $request->validate([
            'amount' => ['required', 'integer', 'min:1'],
            'date' => ['required', 'date'],
            'transaction_category_id' => ['required', 'exists:transaction_categories,id'],
            'transaction_subcategory_id' => ['nullable', 'exists:transaction_subcategories,id'],
        ]);

        $category = TransactionCategory::find($request->get('transaction_category_id'));

        abort_unless($category->user_id == $user->id, 400);
        abort_if($category->subcategories->isNotEmpty() && $request->isNotFilled('transaction_subcategory_id'), 400);

        if ($request->filled('transaction_subcategory_id')) {
            $subcategory = TransactionSubcategory::find($request->get('transaction_subcategory_id'));

            abort_unless($subcategory->user_id == $user->id, 400);
            abort_unless($subcategory->transaction_category_id == $category->getKey(), 400);
        }

        $user->transactions()->create($request->only([
            'amount',
            'date',
            'transaction_category_id',
            'transaction_subcategory_id',
            'comments',
        ]));

        return back()->with('success', true);
    }
}
