<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdate;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function sendEmailNotification($newStatus)
    {
        $user = $this->user;
        $orderDetails = [
            'order_id' => $this->id,
            'total_amount' => $this->total_amount,
            'status' => $newStatus,
            'date' => $this->created_at,
            'products' => $this->products
        ];
    
        Mail::to($user->email)->send(new OrderStatusUpdate($orderDetails));
    }
    

    
    public function sendStatusUpdateNotification($newStatus)
    {
        $user = $this->user; // Récupérez l'utilisateur qui a passé la commande
        $orderProducts = $this->orderProducts; // Récupérez les produits de la commande
        $orderDetails = [
            'id' => $this->id,
            'amount' => $this->total_amount,
            'status' => $newStatus,
            // 'date' => $this->date,
            // 'address' => $this->address,
            // 'orderProducts' => $orderProducts
        ];
        Mail::to($user->email)->send(new OrderStatusUpdate($orderDetails));
    }


}
