<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales_operation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'date',
        'user_id', 
        'quantity_sold', 
        'total_price',
    ];

    public function employees(){

        return $this->belongsTo(Employee::class);
    }
    // public function users(){

    //     return $this->belongsTo(User::class);
        
    // }
    public function users()
{
    return $this->belongsTo(User::class, 'user_id');
}

    //     public function medicines()
    // {
    //     return $this->belongsToMany(Medicine::class, 'sales_med');
    // }
    
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'sales_med', 'sale_opreation_id', 'medicine_id')->withPivot('quantity');
    }
}
