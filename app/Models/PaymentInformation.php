<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInformation extends Model
{
    protected $table = 'payment_i_information_table';

    protected $primaryKey = 'payment_i_information_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'buyers_i_information_id',
        'sales_temp_pa',
        'amount',
        'otp',
        'created_by',
        'data_created',
        'is_active',
        'image_binary'
    ];
}
