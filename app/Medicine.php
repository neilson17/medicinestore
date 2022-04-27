<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function category(){
        // Ayahnya dia adalah category  
        return $this->belongsTo('App\Category', 'category_id');
    }
    
    public function transactions(){
        return $this->belongstoMany('App\Transaction')
            ->withPivot('quantity', 'price');
    }
}
