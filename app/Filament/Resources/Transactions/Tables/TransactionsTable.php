<?php

namespace App\Filament\Resources\Transactions\Tables;

use App\Filament\Exports\TransactionExporter;
use Filament\Actions\DeleteAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Dátum')
                    ->date('Y. F j.')
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('Összeg')
                    ->alignRight()
                    ->money('HUF', decimalPlaces: 0),

                TextColumn::make('category.title')
                    ->label('Kategória'),

                TextColumn::make('subcategory.title')
                    ->label('Alkategória'),

                TextColumn::make('comments')
                    ->label('Megjegyzés')
                    ->wrap()
                    ->size(TextSize::ExtraSmall)
                    ->limit(),
            ])
            ->filters([
                SelectFilter::make('transaction_category_id')
                    ->label('Kategória')
                    ->relationship(
                        name: 'category',
                        titleAttribute: 'title',
                        modifyQueryUsing: fn (Builder $query) => $query->where('transaction_categories.user_id', auth()->id())
                    ),

                SelectFilter::make('transaction_subcategory_id')
                    ->label('Alkategória')
                    ->relationship(
                        name: 'subcategory',
                        titleAttribute: 'title',
                        modifyQueryUsing: fn (Builder $query) => $query->where('transaction_subcategories.user_id', auth()->id())
                    ),

                Filter::make('date')
                    ->schema([
                        DatePicker::make('date_from')->label('-tól'),
                        DatePicker::make('date_until')->label('-id'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(TransactionExporter::class)
                    ->modifyQueryUsing(fn (Builder $query) => $query->where('transactions.user_id', Filament::auth()->id())),
            ])
            ->defaultSort('id', 'desc')
            ->defaultPaginationPageOption(25);
    }
}
