<?php

namespace App\Services;

use App\Traits\FileManagerTrait;

class AuthorService
{
    use FileManagerTrait;

    public function getAddData(object $request): array
    {
        $storage = config('filesystems.disks.default') ?? 'public';
        return [
            'name' => $request['name'],
            'degree' => $request['degree'],
            'image' => $this->upload('author/', 'webp', $request->file('image')),
        ];
    }

    public function getUpdateData(object $request, object $data): array
    {
        $storage = config('filesystems.disks.default') ?? 'public';
        $image = $request->file('image') ? $this->update('author/', $data['image'],'webp', $request->file('image')) : $data['image'];
        return [
            'name' => $request['name'],
            'degree' => $request['degree'],
            'image' => $this->upload('author/', 'webp', $request->file('image')),
        ];
    }

    public function deleteImage(object $data): bool
    {
        if ($data['image']) {$this->delete('author/'.$data['image']);};
        return true;
    }

}
