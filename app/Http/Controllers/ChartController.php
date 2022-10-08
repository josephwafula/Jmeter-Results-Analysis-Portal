<?php

namespace App\Http\Controllers;
use DateTime;
use App\Chart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function index($run_id)
    {
		$averageresponse = DB::table('test_run')
					->select(DB::raw("AVG(elapsed) AS avgres")) 
					->where('run_type_id', '=', $run_id)
					->get();
		
	
		$averagetps = DB::table('test_run')
                     ->select(DB::raw("COUNT(elapsed)/(SELECT duration FROM nftreports.test_run_types WHERE run_type_id = '$run_id') AS avgtps"))
                     ->where('run_type_id', '=', $run_id)
                     ->get();
			
			
		$errors = DB::table('test_run')
                     ->select(DB::raw("count(elapsed) * 100.0/(SELECT COUNT(elapsed) FROM nftreports.test_run WHERE run_type_id = '$run_id') AS errors"))
                     ->where('run_type_id', '=', $run_id)
					 ->where('responsecode', '!=', 200)
                     ->get();
					 
					 
		$slowest = DB::table('test_run')
                     ->select(DB::raw("MAX(elapsed) AS slowest"))
                     ->where('run_type_id', '=', $run_id)
					 ->get();
		
		
		$dtable = DB::table('test_run')
                     ->select(DB::raw("label, AVG(elapsed) AS AVGRes, SUM(allthreads) AS Requests, SUM(responsecode != 200) as SuccessRate, COUNT(elapsed)/(SELECT duration FROM nftreports.test_run_types WHERE run_type_id = '$run_id') AS AVGTPS"))
                     ->where('run_type_id', '=', $run_id)
					 ->groupBy('label')
					 ->get();
					 
		$graph = DB::table('test_run')
                     ->select(DB::raw("elapsed, allthreads"))
                     ->where('run_type_id', '=', $run_id)
					 ->get();
		
		$rows = array();
		$tabled = array();
		
		$tabled['cols'] = array(
		array('id' => '0', 'label' => 'Time','type' => 'number'),
   		array('id' => '1', 'label' => 'Responses', 'type' => 'number'),
		array('id' => '2', 'label' => 'Users','type' => 'number'),
			);
		//put it all together
		foreach ($graph as $key=>$value){
				
			$temp = array();
			$temp[] = array('v' => (string) $key);
			$temp[] = array('v' => (string) $value->elapsed);
			$temp[] = array('v' => (string) $value->allthreads);
			$rows[] = array('c' => $temp);
		}
	
	$tabled['rows'] = $rows;
	$jsonTable = json_encode($tabled);
	
	//print_r($jsonTable);
	return view('dashboard', compact('averageresponse','averagetps', 'errors', 'slowest', 'dtable', 'jsonTable'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
