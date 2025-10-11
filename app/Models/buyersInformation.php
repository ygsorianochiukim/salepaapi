<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buyersInformation extends Model
{
    protected $table = 'buyers_i_information_table';

    protected $primaryKey = 'buyers_i_information_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'buyers_name',
        'contact_number',
        'province',
        'municipality',
        'barangay',
        'purok',
        'zipcode',
        'civil_status',
        'sex',
        'birthdate',
        'birthplace',
        'occupation',
        'company_name',
        'created_by',
        'data_created',
        'temp_ref_id',
        'otp',
        'is_active',
    ];
}
