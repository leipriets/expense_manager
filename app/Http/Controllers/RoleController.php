<?php

namespace App\Http\Controllers;

use App\Role;
use App\Http\Traits\ExpenseManagerTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use ExpenseManagerTrait;

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {

        $data['roles'] = $this->show();

        return view('pages.roles', $data);
    }

    public function role_form(Request $request) {

        return view('includes.role.role-modal',[
            'req' => $request
        ]);
    }

    public function store(Request $request) {

        if ($request->ajax()) {
            
            $request->validate([
                'display_name' => 'required',
                'description' => 'required',
            ]);

            $db = new Role;

            $db->insert([
                'display_name' => $request->display_name,
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

        $db = new Role;

        return $db->get();

    }

    public function update(Request $request) {

        if ($request->ajax()) {

            $request->validate([
                'display_name' => 'required',
                'description' => 'required',
            ]);

            $data = [
                'display_name' => $request->display_name,
                'description' => $request->description,
                'updated_at' => $this->Timestamp()
            ];
            
            $db = new Role;
            
            $db->where('id', $request->r_id)->update($data);
            

            return response()->json([
                'message' => 'Data updated successfully',
                'status_code' => 200
            ], 200);

        }
    }

    public function delete($id) {

        $db = new Role;
        
        $db->find($id)->delete();

        return response()->json([
            'msg' => 'Deleted successfully'
        ]);
        
    }

}
