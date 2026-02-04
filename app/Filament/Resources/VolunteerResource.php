<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VolunteerResource\Pages;
use App\Models\Volunteer;
use App\Models\City;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class VolunteerResource extends Resource
{
    protected static ?string $model = Volunteer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Volunteers';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->maxLength(500)
                            ->rows(2),
                        Forms\Components\Select::make('city_id')
                            ->label('City')
                            ->options(City::pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('age')
                            ->numeric()
                            ->minValue(16)
                            ->maxValue(80),
                    ])->columns(2),

                Forms\Components\Section::make('Skills and Availability')
                    ->schema([
                        Forms\Components\Textarea::make('skills')
                            ->required()
                            ->maxLength(1000)
                            ->rows(3),
                        Forms\Components\Textarea::make('availability')
                            ->required()
                            ->maxLength(500)
                            ->rows(2),
                        Forms\Components\Textarea::make('motivation')
                            ->required()
                            ->maxLength(1000)
                            ->rows(3),
                        Forms\Components\TextInput::make('education')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('occupation')
                            ->maxLength(255),
                    ])->columns(1),

                Forms\Components\Section::make('Emergency Contact')
                    ->schema([
                        Forms\Components\TextInput::make('emergency_contact_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emergency_contact_phone')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('Previous Experience')
                    ->schema([
                        Forms\Components\Toggle::make('has_volunteered_before')
                            ->label('Has volunteered before'),
                        Forms\Components\Textarea::make('previous_volunteer_experience')
                            ->maxLength(1000)
                            ->rows(3)
                            ->visible(fn (Forms\Get $get) => $get('has_volunteered_before')),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                                'inactive' => 'Inactive',
                            ])
                            ->default('pending')
                            ->required(),
                        Forms\Components\Select::make('approved_by')
                            ->label('Approved By')
                            ->relationship('approver', 'name')
                            ->visible(fn (Forms\Get $get) => in_array($get('status'), ['approved', 'rejected'])),
                        Forms\Components\DateTimePicker::make('approved_at')
                            ->label('Approved At')
                            ->visible(fn (Forms\Get $get) => $get('status') === 'approved'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label('City')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'secondary' => 'inactive',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                Tables\Columns\TextColumn::make('age')
                    ->sortable(),
                Tables\Columns\TextColumn::make('approver.name')
                    ->label('Approved By')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('approved_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'inactive' => 'Inactive',
                    ]),
                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name'),
            ])
            ->actions([
                Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Volunteer $record) {
                        $record->update([
                            'status' => 'approved',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                        ]);
                    })
                    ->visible(fn (Volunteer $record) => $record->status === 'pending')
                    ->requiresConfirmation(),
                Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(function (Volunteer $record) {
                        $record->update([
                            'status' => 'rejected',
                            'approved_by' => Auth::id(),
                            'approved_at' => now(),
                        ]);
                    })
                    ->visible(fn (Volunteer $record) => $record->status === 'pending')
                    ->requiresConfirmation(),
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
            'index' => Pages\ListVolunteers::route('/'),
            'create' => Pages\CreateVolunteer::route('/create'),
            'view' => Pages\ViewVolunteer::route('/{record}'),
            'edit' => Pages\EditVolunteer::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}