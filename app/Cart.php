<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 'item_id', 'quantity', 'price', 'item_name', 'sub_total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public static function form()
    {
        return [
            'user_id' => '',
            'item_id' => '',
            'item_name' => '',
            'quantity' => '',
            'price' => '',
            'sub_total' => ''
        ];
    }
}
