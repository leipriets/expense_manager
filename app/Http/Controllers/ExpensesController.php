<?php

namespace App\Http\Controllers;

use App\Expenses;
use App\Http\Traits\ExpenseManagerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{

    use ExpenseManagerTrait;

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        $data['expenses'] = $this->show();
   
        return view('pages.expense', $data );
    }

    public function expense_form(Request $request) {

        $data['expense_categories'] = $this->ExpenseCategories();

        return view('includes.expenses.expenses-modal',[
            'req' => $request,
            'data' => $data
        ]);
    }

    public function store(Request $request) {

        if ($request->ajax()) {
            
            $request->validate([
                'expenses_category' => 'required',
                'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'entry_date' => 'required|date'
            ]);

            $db = new Expenses;

            $db->insert([
                'user_id' => Auth::id(),
                'category' => $request->expenses_category,
                'amount' => $request->amount,
                'entry_date' => $request->entry_date,
                'created_at' => $this->Timestamp()
            ]);

            return response()->json([
                'message' => 'Successfully Saved',
                'status_code' => 200
            ], 200);

        }

    }

    public function edit($id) {

        $db = new Expenses;

        $query = $db->find($id);

        $data['id'] = $query->id;
        $data['category'] = $query->category;
        $data['amount'] = $query->amount;
        $data['entry_date'] = date ('Y-m-d\TH:i:s', strtotime($query->entry_date));

        return response()->json($data, 200) ;
    }

    public function show() {

        $db = new Expenses;

        $query = $db->selectRaw(
            'e.id,
            es.name as category, 
            e.amount, 
            e.entry_date, 
            e.created_at
        ')->from('expenses as e')
        ->leftJoin('expense_categories as es','es.id','=','e.category')
        ->where('e.user_id', Auth::id())
        ->get();

        return $query;
    }

    public function expenses_json() {

        $db = new Expenses;

        $query = $db->selectRaw(
            'e.id,
            es.name as category, 
            e.amount, 
            e.entry_date, 
            e.created_at
        ')->from('expenses as e')
        ->leftJoin('expense_categories as es','es.id','=','e.category')
        ->where('e.user_id', Auth::id())
        ->get();

        $response = array();
        foreach ($query as $expense) {
            $nestedData['name'] = array($expense->category); 
            $nestedData['data'] = array($expense->amount); 
            $response[] = $nestedData;
        }   

        echo json_encode($response,JSON_NUMERIC_CHECK);

    }

    public function update(Request $request) {

        if ($request->ajax()) {

            $request->validate([
                'expenses_category' => 'required',
                'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                'entry_date' => 'required|date'
            ]);

            $data = [
                'category' => $request->expenses_category,
                'amount' => $request->amount,
                'entry_date' => $request->entry_date,
                'updated_at' => $this->Timestamp()
            ];
            
            $db = new Expenses;
            
            $db->where('id', $request->e_id)->update($data);
            

            return response()->json([
                'message' => 'Data updated successfully',
                'status_code' => 200
            ], 200);

        }

    }

    public function delete($id) {

        $db = new Expenses;
        
        $db->find($id)->delete();

        return response()->json([
            'msg' => 'Deleted successfully'
        ]);
        
    }

}
