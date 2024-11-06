<?php

namespace App\Models;

use App\Enums\Publication\StateEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AvailableDay;
use App\Models\Picture;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\CanGetTableNameStatically;
use App\Models\RentType;
class Publication extends Model
{
  use HasFactory, CanGetTableNameStatically;
  protected $fillable = [
    'price',
    'title',
    'ubication',
    'description',
    'room_count',
    'bathroom_count',
    'rent_type_id',
    'user_id',
    'state',
    'pets',
    'number_people'
  ];

  public function getMinPrice(){
    $price = 0.0;
    if($this->exists()){
      $prices = [];
      foreach($this->availableDays as $day){
        $prices[] = $day->finalPrice();
      }

      sort($prices, SORT_ASC & SORT_NUMERIC);
      $price = $prices[0] ?? 0.0;
    }

    return $price;
  }

  public function getHTMLState(): string {
    return match($this->state) {
      StateEnum::Published->name => '<span class="bg-green-400 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Publicado</span>',
      StateEnum::Draft->name => '<span class="bg-yellow-600 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Borrador</span>',
      default => '<span class="bg-gray-500 text-white text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Desconocido</span>'
    };
  }


  protected function title() : Attribute {
    return Attribute::make(
        get: function (string $value) {
          if(empty($value)){
              return '';
          }
          return Str::title($value);
        }
    );
  }

  protected function description() : Attribute {
    return Attribute::make(
        get: function ($value) {
          if(empty($value) || !is_string($value )){
            return '';
          }
          return Str::ucfirst($value);
        }
    );
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function availableDays(): HasMany
  {
    return $this->hasMany(AvailableDay::class);
  }

  public function pictures()
  {
    return $this->hasMany(Picture::class);
  }

  public function rentType()
  {
    return $this->belongsTo(RentType::class);
  }

  public function getUrlPicture(int $id): string
  {
    $filename = '';
    if ($this->exists()) {
      $picture = $this->pictures->find($id);

      $filename = asset("publication-pictures/{$this->id}/{$picture->name}");
    }
    return $filename;
  }

  public function getFirstPicture(): string
  {
    $defaultPath = asset(Picture::DEFAULT_PICTURE);

    if ($this->exists()) {
      $picture = $this->pictures->first() ?? '';

      if ( empty($picture) ) {
        return $defaultPath;
      }

      $path = "{$this->id}/{$picture->name}";
      if (Storage::disk('publication-pictures')->exists($path)) {
        return asset("publication-pictures/$path");
      }

    }
    return $defaultPath;
  }

  public function getDateLongFormat(DateColumns $column = DateColumns::Created_at): string
  {
    $columnToGet = $column->value;
    Carbon::setLocale('es');
    $date = Carbon::parse($this->$columnToGet);
    $dateString = $date->locale('es');
    if ($this->exists()) {
      return $dateString->translatedFormat('d/m/Y');
    }
    return '';
  }

  public function getDateShortFormat(DateColumns $column = DateColumns::Created_at): string
  {
    $columnToGet = $column->value;
    Carbon::setLocale('es');
    $date = Carbon::parse($this->$columnToGet);
    $dateString = $date->locale('es');
    if ($this->exists()) {
      return $dateString->translatedFormat('d/m/Y');
    }
    return '';
  }
  

  public function extractRecord(array $data) : array {
    $record = [];
    foreach ($data as $key => $value) {
      if(in_array($key, $this->getFillable())) {
        $record[$key] = $value;
      }
    }
    return $record;
  }
  
}

enum DateColumns : string {
  case Created_at = 'created_at';
  case updated_at = 'updated_at';
}
