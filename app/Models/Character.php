<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    // Tanpa ini, data TIDAK AKAN PERNAH masuk ke database (Security Feature Laravel)
    protected $fillable = ['project_id', 'name', 'image'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}