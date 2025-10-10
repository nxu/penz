<?php

use App\Models\TransactionCategory;
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
        Schema::create('transaction_categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('color', 32)->nullable()->default(null);
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('order_column')->default(0);
        });

        Schema::create('transaction_subcategories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('color', 32)->nullable()->default(null);

            $table->foreignIdFor(TransactionCategory::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('order_column')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_subcategories');
        Schema::dropIfExists('transaction_categories');
    }
};
