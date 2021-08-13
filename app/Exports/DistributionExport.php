<?php

namespace App\Exports;

use App\Models\Client\Transactions\Distribution;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class DistributionExport implements FromView, WithColumnWidths
{
    public function view(): View
    {
        $distributions = Distribution::byCompany(Auth::user()->userable->id)->get();
        return view('reporting.export.distribution', compact('distributions'));
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 35,
            'D' => 25,
            'E' => 15,
            'F' => 15,
        ];
    }
}
