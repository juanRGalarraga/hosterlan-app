<?php

namespace App\Models;

use App\Enums\Publication\AvailableDayEnum;
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

    public function isAvailable(){
        if(!$this->exists()) return false;
        debugbar()->debug($this->state == AvailableDayEnum::Available->name);
        return $this->state == AvailableDayEnum::Available->name;
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    protected function since(){
        return Attribute::make(
            set: fn(string $value) => \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
            get: fn(string $value) => \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y'),
        );
    }
    protected function to(){
        return Attribute::make(
            set: fn(string $value) => \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d'),
            get: fn(string $value) => \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y')
        );
    }
}
