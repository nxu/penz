<?php

namespace App\Filament\Resources\TransactionSubcategories;

use App\Filament\Resources\TransactionSubcategories\Pages\CreateTransactionSubcategory;
use App\Filament\Resources\TransactionSubcategories\Pages\EditTransactionSubcategory;
use App\Filament\Resources\TransactionSubcategories\Pages\ListTransactionSubcategories;
use App\Filament\Resources\TransactionSubcategories\Schemas\TransactionSubcategoryForm;
use App\Filament\Resources\TransactionSubcategories\Tables\TransactionSubcategoriesTable;
use App\Models\TransactionSubcategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionSubcategoryResource extends Resource
{
    protected static ?string $model = TransactionSubcategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Alkategóriák';

    protected static ?string $label = 'Alkategória';

    protected static ?string $pluralLabel = 'Alkategóriák';

    protected static ?int $navigationSort = 10;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('transaction_subcategories.user_id', auth()->id());
    }

    public static function form(Schema $schema): Schema
    {
        return TransactionSubcategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransactionSubcategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransactionSubcategories::route('/'),
            'create' => CreateTransactionSubcategory::route('/create'),
            'edit' => EditTransactionSubcategory::route('/{record}/edit'),
        ];
    }
}
