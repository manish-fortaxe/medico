<?php

namespace App\Services;

use App\Traits\FileManagerTrait;
use Str;

class TagService
{
    use FileManagerTrait;

    public function getAddData(object $request): array
    {
        return [
            'tag' => $request['tag'],
            'slug' => $this->getSlug($request),
            'description' => $request['description'],
            'status' => 1,
        ];
    }

    public function getUpdateData(object $request, object $data): array
    {
        return [
            'tag' => $request['tag'],
            'slug' => $this->getSlug($request),
            'description' => $request['description'],
            'status' => 1,
        ];
    }

    public function getSlug(object $request): string
    {
        return Str::slug($request['tag']) . '-' . Str::random(6);
    }

}
