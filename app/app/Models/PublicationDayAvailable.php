<?php

namespace App\Models;

use App\Enums\Publication\AvailableDayEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CanGetTableNameStatically;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->state == AvailableDayEnum::Available->name;
    }

    public function publication() : BelongsTo
    {
        return $this->belongsTo(Publication::class);
    }
    
    public function guests() : HasMany {
        return $this->hasMany(Guest::class);
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
