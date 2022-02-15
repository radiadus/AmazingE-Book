<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    use HasFactory;

    protected $primaryKey = 'ebook_id';

    protected $fillable = [
        'ebook_id', 'title', 'author', 'description',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'ebook_id', 'ebook_id');
    }
}
