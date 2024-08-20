<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationsAvailablesDays extends Model
{
    use HasFactory;
    protected $fillable = [
      'publication_id',
      'since',
      'to',
      'state'
    ];
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }
}