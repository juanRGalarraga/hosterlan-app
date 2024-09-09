<?php

namespace App\Models;

use App\Enums\Publication\AvailableDayEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CanGetTableNameStatically;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublicationDayAvailable extends Model
{
    use HasFactory, CanGetTableNameStatically;
    protected $fillable = [
        'guest_id',
        'publication_id',
        'since',
        'to',
        'state'
    ];

    public function isAvailable(){
        if(!$this->exists()) return false;
        return $this->state == AvailableDayEnum::Available->name;
    }

    public function guest(){
        return $this->belongsTo(Guest::class);
    }

    public function publication() : BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }

    protected function since() : Attribute {
        return Attribute::make(
            get: fn(string $value) => \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y'),
        );
    }
    protected function to() : Attribute {
        return Attribute::make(
            get: fn(string $value) => \DateTime::createFromFormat('Y-m-d', $value)->format('d/m/Y')
        );
    }
}
