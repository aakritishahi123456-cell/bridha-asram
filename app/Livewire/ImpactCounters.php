<?php

namespace App\Livewire;

use App\Models\ImpactMetric;
use App\Models\Donation;
use App\Models\Volunteer;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class ImpactCounters extends Component
{
    public $counters = [];
    public $isLoading = true;

    public function mount()
    {
        $this->loadCounters();
    }

    public function loadCounters()
    {
        // Cache the counters for 5 minutes to improve performance
        $this->counters = Cache::remember('impact_counters', 300, function () {
            return [
                'people_sheltered' => $this->getPeopleSheltered(),
                'elderly_cared' => $this->getElderlyCared(),
                'meals_served' => $this->getMealsServed(),
                'volunteers' => $this->getActiveVolunteers(),
                'donations_received' => $this->getTotalDonations(),
                'cities_served' => $this->getCitiesServed(),
            ];
        });

        $this->isLoading = false;
    }

    private function getPeopleSheltered()
    {
        return ImpactMetric::where('metric_name', 'people_sheltered')
            ->sum('metric_value') ?: 0;
    }

    private function getElderlyCared()
    {
        return ImpactMetric::where('metric_name', 'elderly_cared')
            ->sum('metric_value') ?: 0;
    }

    private function getMealsServed()
    {
        return ImpactMetric::where('metric_name', 'meals_served')
            ->sum('metric_value') ?: 0;
    }

    private function getActiveVolunteers()
    {
        return Volunteer::where('status', 'approved')->count();
    }

    private function getTotalDonations()
    {
        return Donation::where('payment_status', 'completed')
            ->sum('amount') ?: 0;
    }

    private function getCitiesServed()
    {
        return ImpactMetric::distinct('city_id')
            ->whereNotNull('city_id')
            ->count() ?: 2; // Default to Surkhet and Jajarkot
    }

    public function refreshCounters()
    {
        Cache::forget('impact_counters');
        $this->loadCounters();
        $this->dispatch('counters-refreshed');
    }

    public function render()
    {
        return view('livewire.impact-counters');
    }
}