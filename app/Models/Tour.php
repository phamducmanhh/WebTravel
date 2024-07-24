<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'tour_code',
        'slug', 
        'description', 
        'price', 
        'category_id', 
        'vehicle', 
        'departure_date', 
        'return_date', 
        'tour_from', 
        'tour_to', 
        'tour_time', 
        'quantity', 
         'image',
        'status', 
        
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
