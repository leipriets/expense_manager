<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategories extends Model
{
    protected $fillable = [
        'name', 'description'
    ];
}
