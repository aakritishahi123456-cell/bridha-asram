<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Donations'),
            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'pending'))
                ->badge(fn () => $this->getModel()::where('payment_status', 'pending')->count())
                ->badgeColor('warning'),
            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'completed'))
                ->badge(fn () => $this->getModel()::where('payment_status', 'completed')->count())
                ->badgeColor('success'),
            'failed' => Tab::make('Failed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'failed'))
                ->badge(fn () => $this->getModel()::where('payment_status', 'failed')->count())
                ->badgeColor('danger'),
        ];
    }
}