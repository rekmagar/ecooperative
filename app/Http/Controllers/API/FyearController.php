<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fyear;
use Illuminate\Support\Facades\DB;
class FyearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['fyear' => fyear::all()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $per_page = $request->per_page ? $request->per_page : 5;
        // $sort_by = $request->sort_by;
        // $order_by = $request->order_by;
        // return response()->json(['fyear' => fyear::orderBy($sort_by, $order_by)->paginate($per_page)], 200);

        $recid = DB::table('fyears')->count() + 1;
        $cntValue = DB::table('fyears')->where('recid', $recid)->count();
        while ($cntValue > 0) {
            $recid = $recid + 1;
            $cntValue = DB::table('fyears')->where('recid', $recid)->count();
        }

        $fyear = fyear::create([
            'recid'     => $recid,
            'fyear'     => $request->fyear,
            'begdate'   => $request->begdate,
            'enddate'   => $request->enddate,
            'remarks'   => $request->remarks,
            'euser'     => $request->tmpUser,
            'edate'     => $request->tmpDate,
            'etime'     => $request->tmpTime,
            'llcode'    => $request->llcode,
            'cmpcode'   => $request->cmpcode,
        ]);
        return response()->json(['fyear' => $fyear], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $fyear = fyear::where('fyear', 'LIKE', "%$id%")->paginate();
        // return response()->json(['fyear' => $fyear], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fyear = fyear::find($id);
        $fyear->fyear     = $request->fyear;
        $fyear->begdate   = $request->begdate;
        $fyear->enddate   = $request->enddate;
        $fyear->remarks   = $request->remarks;
        $fyear->uuser     = $request->tmpUser;
        $fyear->udate     = $request->tmpDate;
        $fyear->utime     = $request->tmpTime;
        $fyear->llcode    = $request->llCode;
        $fyear->cmpcode   = $request->cmpcode;
        $fyear->save();
        return response()->json(['fyear' => $fyear], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fyear = fyear::find($id)->delete();
        return  response()->json(['fyear' => $fyear], 200);
    }

    public function deleteAll(Request $request)
    {
        fyear::whereIn('id', $request->fyear)->delete();
        return response()->json(['message', 'Records Deleted Successfully'], 200);
    }
}
