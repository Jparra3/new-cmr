<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Customer;

class Transaction extends Model
{
    //
    use softDeletes;

    protected $table = 'transactions';

    /**
     * columna primaria
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
    	'name',
    	'amount',
    	'customer_id',
    ];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }

}
