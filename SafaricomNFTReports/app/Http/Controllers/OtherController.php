<?php
/**
 * PHP version 7.2.13 and Laravel version 5.8.17
 * Admin Controller Class
 * Provides functionality for maintainining the admin basic detail
 *
 * @Package             Controllers
 * @Author              AC Jerin Monish
 * @Created On          15-05-2018
 * @Modified            AC Jerin Monish
 * @Modified On         15-05-2018
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\DB;
use DateTime;
class OtherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function listAllProjects(){
        $data = DB::table('projects')->get();
        return view('Other-list',['data' => $data]);
    }
	
	public function summaryreport($project_id)
{
	$datetime = DB::table('test_summary')
	->where('project_id', '=', $project_id)
	->orderBy('created_at', 'desc')
	->value('created_at');
	
	$createDate = new DateTime($datetime);
	$date = $createDate->format('Y-m-d');
	
	$data = DB::table('test_summary')
    ->select('test_summary.*')
    ->whereDate('test_summary.created_at', '=', $date)
	->where('test_summary.project_id', '=', $project_id)
    ->get();
	
	$TPS = DB::table('test_summary')
	->select('test_summary.AVG_TPS')
    ->whereDate('test_summary.created_at', '=', $date)
	->where('test_summary.project_id', '=', $project_id)
	->sum('AVG_TPS');
	
	$expectedTPS = DB::table('projects')
   	->select('expected_TPS')
    ->where('project_id', '=', $project_id)
    ->get();
	
	return view('run-summary',['data' => $data, 'expectedTPS' => $expectedTPS, 'TPS' => $TPS]);
	}
}
