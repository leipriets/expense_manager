<?php 

namespace App\Http\Traits;
use Carbon\Carbon;
use App\ExpenseCategories;
use App\Role;

trait ExpenseManagerTrait {


    public function Timestamp() {

        return $current_date_time = Carbon::now()->toDateTimeString();
    }

    public function ExpenseCategories() {

        $db = new ExpenseCategories;

        return $db->get();
    }

    public function UserRole() {

        $db = new Role;

        return $db->get();

    }


}
