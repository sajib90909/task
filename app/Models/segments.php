<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class segments extends Model
{
    use HasFactory;
    public function segmentLogic(){
        return $this->hasMany(segmentLogics::class);
    }
}
