<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CanGetTableNameStatically;
use Carbon\Carbon;

class PublicationDayAvailable extends Model
{
    use HasFactory, CanGetTableNameStatically;
    protected $fillable = [
      'publication_id',
      'since',
      'to',
      'state'
    ];

    protected $cast = [
        'since' => 'datetime:Y-m-d',
        'to' => 'datetime:Y-m-d',
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    protected function since(){
        return Attribute::make(
            set: fn(string $value) => \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d')
        );
    }
    protected function to(){
        return Attribute::make(
            set: fn(string $value) => \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d')
        );
    }
}
