<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code_area',
        'number',
        'is_default'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

}
