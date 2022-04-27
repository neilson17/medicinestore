<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // karena dibuat manual maka tidak ada created_at dan updated_at dan ketika kita input & edit data maka akan error karena mau dimasukkan 2 kolom itu tp tdk ada di db
    // maka harus dideclare bahwa ini tidak ada timestamps
    public $timestamps = false;
}
