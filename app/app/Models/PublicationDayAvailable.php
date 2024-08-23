<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CanGetTableNameStatically;

class PublicationDayAvailable extends Model
{
    use HasFactory, CanGetTableNameStatically;
    protected $fillable = [
      'publication_id',
      'since',
      'to',
      'state'
    ];
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}
