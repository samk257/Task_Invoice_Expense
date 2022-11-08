<?php

namespace App\Http\Controllers;

use App\Models\Bugdet;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[
            "incomes"=>Bugdet::where('type',"1" )->get(),
            "expenses"=>Bugdet::where('type',"0" )->get(),
            "totalbudget"=>Bugdet::sum('number'),
        ];
        $totalbu=Bugdet::sum('number');
        $incomestotal=Bugdet::where('type',"1" )->sum('number');
        $expenstotal=Bugdet::where('type',"0" )->sum('number');



        if ($totalbu != 0) {
            $percent = round(($expenstotal * 100 / $totalbu),2) ;
            } else {
            $percent = 0;
            }
        // dd($data);
        return  view('Task.task',["percent"=>$percent,"incomestotal"=>$incomestotal,"expenstotal"=>$expenstotal],$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Task.taskadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'description' => 'required',
            'number' => 'required',
        ]);

        Bugdet::create($request->post());

        return redirect()->route('tasks.index')->with('success','Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bugdet=Bugdet::find($id);
        $bugdet->delete();
        return redirect()->route('tasks.index')->with('success','Deleted successfully');
    }
}
