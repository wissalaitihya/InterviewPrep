<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'name', 'color', 'category'];

    protected static function booted(): void
    {
        static::deleting(function (Domain $domain) {
            if ($domain->isForceDeleting()) {
                $domain->concepts()->withTrashed()->each(fn (Concept $c) => $c->forceDelete());
            } else {
                $domain->concepts()->each(fn (Concept $c) => $c->delete());
            }
        });

        static::restored(function (Domain $domain) {
            $domain->concepts()->withTrashed()->each(fn (Concept $c) => $c->restore());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concepts()
    {
        return $this->hasMany(Concept::class);
    }
}
