<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    

    public function carts()
        {
            return $this->hasMany(Cart::class);
        }
    
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
