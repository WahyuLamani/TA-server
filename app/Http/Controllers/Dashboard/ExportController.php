<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\AgentExport;
use App\Exports\DistributionExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportAgents(AgentExport $agent)
    {
        return Excel::download($agent, 'Agentcompany.xlsx');
    }
    public function exportDistributions(DistributionExport $distributions)
    {
        return Excel::download($distributions, 'Distributions.xlsx');
    }
}
