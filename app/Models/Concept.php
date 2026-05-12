<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concept extends Model
{
    use SoftDeletes;
    protected $fillable = ['domain_id', 'title', 'explanation', 'difficulty', 'status'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    public function generatedQuestion()
    {
        return $this->hasMany(GeneratedQuestion::class);
    }
    public function getStatusLabelAttribute():string
    {
        return match ($this->status) {
            'to_review' => 'A revoir',
            'in_progress' => 'En cours',
            'mastered' => 'Maitrise',
            default => $this->status,
        };
    }
    public function getDifficultyLabelAttribute():string
    {
        return match ($this->difficulty) {
            'junior' => 'Junior',
            'mid' => 'Mid',
            'senior' => 'Senior',
            default => $this->difficulty,
        };
    }
}
