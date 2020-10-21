<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ExpenseManagerTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use ExpenseManagerTrait;

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        $data['users'] = $this->show();

        return view('pages.user', $data);
    }

    public function user_form(Request $request) {

        $data['roles'] = $this->UserRole();
        
        return view('includes.user.user-modal', [
            'req' => $request,
            'data' => $data
        ]);
    }

    public function store(Request $request){

        if ($request->ajax()) {
            
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'role' => 'required'
            ]);

            $db = new User;

            $db->insert([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->name),
                'created_at' => $this->Timestamp()
            ]);

            return response()->json([
                'message' => 'Successfully Saved',
                'status_code' => 200
            ], 200);

        }
    }

    public function show() {

        $db = new User;
        return $db->get();
    }

    public function update(Request $request) {

        if ($request->ajax()) {

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'role' => 'required'
            ]);

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'updated_at' => $this->Timestamp()
            ];
            
            $db = new User;
            
            $db->where('id', $request->user_id)->update($data);
            

            return response()->json([
                'message' => 'Data updated successfully',
                'status_code' => 200
            ], 200);        

        }
    }

    public function delete($id) {

        $db = new User;
        
        $db->find($id)->delete();

        return response()->json([
            'msg' => 'Deleted successfully'
        ]);
        
    }


}
