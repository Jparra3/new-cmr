<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Transaction;

class Customer extends Model
{
    use softDeletes;
    /**
     * Nombre de la tabla
     * @var string
     */
    protected $table = 'customers';
    /**
     * Columna primaria
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Campos que se pueden asignar masivamente
     * @var [type]
     */
    protected $fillable = [
    'first_name',
    'last_name',
    'email',
    ];

    public function transactions()
    {
    	return $this->hasMany(Transaction::class);
    }   

}
