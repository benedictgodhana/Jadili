<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\UssdResponse;
use App\Models\UssdFlow;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search', '');

        $ussdFlows = UssdFlow::with(['ussdFlowSteps.ussdResponses'])
            ->where('flow_name', 'like', "%{$searchQuery}%")
            ->orWhereHas('ussdFlowSteps', function ($query) use ($searchQuery) {
                $query->where('message', 'like', "%{$searchQuery}%")
                    ->orWhereHas('ussdResponses', function ($query) use ($searchQuery) {
                        $query->where('response', 'like', "%{$searchQuery}%");
                    });
            })
            ->get();

        $combinedData = $ussdFlows->map(function ($flow) {
            return $flow->ussdFlowSteps->map(function ($step) use ($flow) {
                return $step->ussdResponses->map(function ($response) use ($flow, $step) {
                    return [
                        'flow_name' => $flow->flow_name,
                        'step_name' => $step->step_name ?? 'N/A',
                        'response'  => $response->response,
                    ];
                });
            })->flatten(1);
        })->flatten(1);

        return Inertia::render('Response', [
            'combinedData' => $combinedData,
        ]);
    }


}
