<?php

namespace App\Http\Controllers;

use App\ExpenseCategories;
use App\Http\Traits\ExpenseManagerTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ExpenseCategoriesController extends Controller
{
    use ExpenseManagerTrait;

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        $data['categories'] = $this->show();
   
        return view('pages.expense_categories', $data );
    }

    public function edit(Request $request) {

        $db = new ExpenseCategories;

        return $db->find($request->id);

    }

    public function store(Request $request) {


        if ($request->ajax()) {
            
            $request->validate([
                'name' => 'required|string|max:255|unique:expense_categories',
                'description' => 'required|string|max:255',
            ]);

            $db = new ExpenseCategories;

            $db->insert([
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => $this->Timestamp()
            ]);

            return response()->json([
                'message' => 'Successfully Saved',
                'status_code' => 200
            ], 200);

        }

    }

    public function show() {

        $db = new ExpenseCategories;

        return $db->get();
    }

    public function update(Request $request) {

        if ($request->ajax()) {

            $request->validate([
                'name' => 'required|string|max:255|unique:expense_categories',
                'description' => 'required|string|max:255',
            ]);

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'updated_at' => $this->Timestamp(),
            ];
            
            $db = new ExpenseCategories;
            
            $db->where('id', $request->ec_id)->update($data);
            

            return response()->json([
                'message' => 'Data updated successfully',
                'status_code' => 200
            ], 200);

        }

    }    

    public function delete($id) {

        $db = new ExpenseCategories;
        
        $db->find($id)->delete();

        return response()->json([
            'msg' => 'Deleted successfully'
        ]);
        
    }
}
