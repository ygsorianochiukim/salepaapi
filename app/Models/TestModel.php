<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    protected $connection = 'mysql_secondary';
    protected $table = 'users';
}
