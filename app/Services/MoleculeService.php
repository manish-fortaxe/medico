<?php

namespace App\Services;

use App\Traits\FileManagerTrait;
use Str;

class MoleculeService
{
    use FileManagerTrait;

    public function getAddData(object $request): array
    {
        return [
            'name' => $request['name'],
            'slug' => $this->getSlug($request),
            'description' => $request['description'],
            'status' => 1,
        ];
    }

    public function getUpdateData(object $request, object $data): array
    {
        return [
            'name' => $request['name'],
            'slug' => $this->getSlug($request),
            'description' => $request['description'],
            'status' => 1,
        ];
    }

    public function getSlug(object $request): string
    {
        return Str::slug($request['name']);
    }

}
