<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\StorageTrait;

class Author extends Model
{
    use HasFactory, StorageTrait;
    protected $guarded = [];
    protected $appends = ['image_full_url'];

    public function getImageFullUrlAttribute():array
    {
        $value = $this->image;
        return $this->storageLink('author',$value, 'public');
    }

}
