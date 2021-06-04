<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllResource;
use App\Models\Client\ProblemReporting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = ProblemReporting::where('agent_id', Auth::user()->userable->id)->get();
        return response(['reports' => AllResource::collection($reports), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'post' => 'required',

        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $data['agent_id'] = Auth::user()->userable_id;
        $reports = ProblemReporting::create($data);


        return response(['reports' => new AllResource($reports), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProblemReporting  $problemReporting
     * @return \Illuminate\Http\Response
     */
    public function show(ProblemReporting $problemReporting)
    {
        return response(['project' => new AllResource($problemReporting), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProblemReporting  $problemReporting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProblemReporting $problemReporting)
    {
        $problemReporting->update($request->all());

        return response(['project' => new AllResource($problemReporting), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProblemReporting  $problemReporting
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProblemReporting $problemReporting)
    {
        //
    }
}
