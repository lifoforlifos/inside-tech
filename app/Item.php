<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'reference', 'name', 'description', 'category', 'price', 'discount', 'stock'
    ];

    public function chart()
    {
        return $this->hasMany(Chart::class);
    }

    public static function form()
    {
        return [
            'reference' => '',
            'name' => '',
            'description' => '',
            'category' => ['rfid', 'incendie', 'acces', 'video', 'alarme', 'temps', 'solaire', 'vente'],
            'price' => '',
            'discount' => '',
            'stock' => '',
        ];
    }
}
