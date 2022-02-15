<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_id',
        'account_id',
        'ebook_id',
        'order_date',
    ];

    public function accounts()
    {
        return $this->belongsTo('App\Models\Account');
    }

    public function e_books()
    {
        return $this->belongsTo('App\Models\EBook', 'ebook_id', 'ebook_id');
    }
}
