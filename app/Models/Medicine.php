<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Medicine extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $fillable = [
        'name',
        'quantity',
        'company_name',
        'prescription_status',
        'category_id',
        'production_date',
        'expiration_date',
        'purchase_price',
        'selling_price',
        'med_image',
        'alternative',
        'description',
        'contraindications',
        'dose',
        'medicine_shape',
        'max_quantity_allowed',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sales_operations()
    {
        return $this->belongsToMany(Sales_operation::class, 'sales_med', 'medicine_id', 'sale_opreation_id')->withPivot('quantity');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_med');
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // إلحاق اسم الفئة مع بيانات الفهرسة
        $array['category'] = $this->category ? $this->category->name : null;

        return [
            'name' => $array['name'],
            'company_name' => $array['company_name'],
            'category_id' => $array['category_id'], // إضافة category_id إلى بيانات الفهرسة
        ];
    }

    /**
     * Define the searchable fields.
     *
     * @return array
     */
    public static function getSearchableFields()
    {
        return ['name', 'company_name',  'category_id'];
    }
}
