<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessMenuUserModel extends Model
{
    use HasFactory;

    protected $table = 'tbt_user_access_menu';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'emp_id', 'employee_code');
    }
}
