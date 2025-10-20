<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseMonitoring extends Model
{
    protected $table = 'purchase_i_information_table';

    protected $primaryKey = 'purchase_i_information_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'buyers_i_information_id',
        'mp_i_lot_id',
        'payment_type',
        'terms',
        'beneficiary1',
        'beneficiary2',
        'datePayment',
        'sales_temp_pa',
        'e_signature',
        'is_active',
        'date_created',
        'created_by',
    ];
}
