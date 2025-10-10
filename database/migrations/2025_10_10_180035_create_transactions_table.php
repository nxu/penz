<?php

use App\Models\TransactionCategory;
use App\Models\TransactionSubcategory;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->text('comments')->nullable()->default(null);

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(TransactionCategory::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(TransactionSubcategory::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->index(['user_id', 'transaction_category_id', 'transaction_subcategory_id'], 'transaction_category_idx');
            $table->index(['user_id', 'date', 'transaction_category_id', 'transaction_subcategory_id'], 'transaction_date_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
