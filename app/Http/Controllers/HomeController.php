<?php

namespace App\Http\Controllers;

use App\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        // $request->user()->authorizeRoles(['admin', 'user']);

        return view('home');
    }

    public function expenses_json() {

        $db = new Expenses;

        $query = $db->selectRaw(
            'es.name as category, 
            SUM(e.amount) as amount
        ')->from('expenses as e')
        ->leftJoin('expense_categories as es','es.id','=','e.category')
        ->when( Auth::user()->role !== 'admin', function($query) {
            return $query->where('e.user_id', Auth::id());
        })
        ->groupBy('es.name','e.category')        
        ->get();

        $response = array();
        foreach ($query as $expense) {
            $nestedData['name'] = array($expense->category); 
            $nestedData['data'] = array($expense->amount); 
            $response[] = $nestedData;
        }   

        return response()->json($response);

        // echo json_encode($response,JSON_NUMERIC_CHECK);
    }

}
