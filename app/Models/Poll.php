<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = ['title'];

    // every poll must have option
    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
