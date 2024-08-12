<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Picture;
use Carbon\Carbon;

class Publication extends Model
{
    use HasFactory;
    protected $fillable = [
      'price',
      'title',
      'ubication',
      'description',
      'room_count',
      'bathroom_count',
      'rent_type',
      'pets',
      'number_people'
    ];

    public function pictures(){
      return $this->hasMany(Picture::class);
    }
    
    public function rentType(){
      return $this->hasOne(RentType::class);
    }

    public function getUrlPicture(int $id){
      $filename = '';
      if($this->exists()){
        $picture = $this->pictures->find($id);
        $filename = asset("imgs/publications/{$this->id}/{$picture->name}.{$picture->type}");
      }
      return $filename;
    }

    public function getFirstPicture(){
      $filename = '';
      if($this->exists()){
        $picture = $this->pictures[0] ?? '';
        if(!empty($picture)){
          $filename = asset("imgs/publications/{$this->id}/{$picture->name}.{$picture->type}");
        }
      }
      return $filename;
    }

    public function getFormattedUpdateAt(){
      if($this->exists()){
        return Carbon::createFromTimestamp($this->created_at)->format('l jS \\of F Y h:i:s A');
      }
      return '';
    }
}
