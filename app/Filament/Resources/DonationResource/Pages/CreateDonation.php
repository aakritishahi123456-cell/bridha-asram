<?php

namespace App\Filament\Resources\DonationResource\Pages;

use App\Filament\Resources\DonationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDonation extends CreateRecord
{
    protected static string $resource = DonationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Generate receipt number if not provided
        if (empty($data['receipt_number'])) {
            $lastDonation = \App\Models\Donation::latest('id')->first();
            $nextId = $lastDonation ? $lastDonation->id + 1 : 1;
            $data['receipt_number'] = 'NGO-' . str_pad($nextId, 6, '0', STR_PAD_LEFT) . '-' . date('Y');
        }

        return $data;
    }
}