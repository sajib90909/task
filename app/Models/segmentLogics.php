<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class segmentLogics extends Model
{
    use HasFactory;
    public function segments(){
        return $this->belongsTo(segments::class);
    }
}
