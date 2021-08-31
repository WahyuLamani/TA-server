<?php

namespace App\Http\Livewire;

use App\Models\Tracking as ModelsTracking;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tracking extends Component
{
    public $geoJson;
    public $locations;

    public function loadLocations()
    {
        $this->locations = ModelsTracking::whereHas('tracing', function ($q) {
            $q->where('company_id', Auth::user()->userable->id);
        })->latest()->get();
        // $tes = json_encode($location);
        $convertLocations = [];

        foreach ($this->locations as $location) {
            $convertLocations[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [$location->longitude, $location->latitude],
                    'type' => 'Point'
                ],
                'properties' => [
                    'id' => $location->id,
                    'name' => $location->tracing->name,
                    'image' => $location->tracing->thumbnail,
                ]
            ];
        }

        $geoLocation = [
            'type' => 'FeatureCollection',
            'features' => $convertLocations
        ];
        $geoJson = collect($geoLocation)->toJson();

        $this->geoJson = $geoJson;
    }

    public function render()
    {
        $this->loadLocations();
        return view('livewire.tracking');
    }
}
