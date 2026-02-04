<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Donations';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Donor Information')
                    ->schema([
                        Forms\Components\TextInput::make('donor_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('donor_email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('donor_phone')
                            ->tel()
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('Donation Details')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('NPR')
                            ->minValue(10)
                            ->maxValue(1000000),
                        Forms\Components\Select::make('currency')
                            ->options([
                                'NPR' => 'Nepali Rupees (NPR)',
                            ])
                            ->default('NPR')
                            ->required(),
                        Forms\Components\Select::make('purpose')
                            ->options([
                                'homeless_care' => 'Homeless Care',
                                'elderly_care' => 'Elderly Care',
                                'general_fund' => 'General Fund',
                            ])
                            ->required(),
                        Forms\Components\Select::make('payment_method')
                            ->options([
                                'esewa' => 'eSewa',
                                'khalti' => 'Khalti',
                                'bank_transfer' => 'Bank Transfer',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\TextInput::make('transaction_id')
                            ->maxLength(255),
                        Forms\Components\Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                            ])
                            ->default('pending')
                            ->required(),
                        Forms\Components\TextInput::make('receipt_number')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(1000)
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('receipt_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('donor_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('donor_email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('NPR')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('purpose')
                    ->colors([
                        'primary' => 'homeless_care',
                        'success' => 'elderly_care',
                        'warning' => 'general_fund',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'homeless_care' => 'Homeless Care',
                        'elderly_care' => 'Elderly Care',
                        'general_fund' => 'General Fund',
                        default => $state,
                    }),
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'completed',
                        'danger' => 'failed',
                        'secondary' => 'refunded',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'esewa' => 'eSewa',
                        'khalti' => 'Khalti',
                        'bank_transfer' => 'Bank Transfer',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
                SelectFilter::make('purpose')
                    ->options([
                        'homeless_care' => 'Homeless Care',
                        'elderly_care' => 'Elderly Care',
                        'general_fund' => 'General Fund',
                    ]),
                SelectFilter::make('payment_method')
                    ->options([
                        'esewa' => 'eSewa',
                        'khalti' => 'Khalti',
                        'bank_transfer' => 'Bank Transfer',
                    ]),
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListDonations::route('/'),
            'create' => Pages\CreateDonation::route('/create'),
            'view' => Pages\ViewDonation::route('/{record}'),
            'edit' => Pages\EditDonation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('payment_status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}