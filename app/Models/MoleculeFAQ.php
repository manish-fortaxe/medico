<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoleculeFAQ extends Model
{
    use HasFactory;

    protected $guarded = [];

    function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
