<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratedQuestion extends Model
{
    protected $fillable = ['concept_id', 'questions'];

    protected $casts = [
        'questions' => 'array',
    ];
    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }
}
