<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
  protected $fillable = ['user_id', 'name', 'color'];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
   public function concepts()
   {
    return $this->hasMany(Concept::class);
   }
}
