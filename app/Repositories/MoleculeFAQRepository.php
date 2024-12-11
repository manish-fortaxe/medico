<?php

namespace App\Repositories;

use App\Contracts\Repositories\MoleculeFAQRepositoryInterface;
use App\Models\MoleculeFAQ;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class MoleculeFAQRepository implements MoleculeFAQRepositoryInterface
{
    public function __construct(
        private readonly MoleculeFAQ $faq,
    )
    {
    }


    public function add(array $data): string|object
    {
        return $this->faq->create($data);
    }

    public function getFirstWhere(array $params, array $relations = []): ?Model
    {
        return $this->faq->where($params)->first();
    }

    public function getList(array $orderBy = [], array $relations = [], int|string $dataLimit = DEFAULT_DATA_LIMIT, int $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->faq
            ->when(!empty($orderBy), function ($query) use ($orderBy) {
                $query->orderBy(array_key_first($orderBy), array_values($orderBy)[0]);
            });
        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit);
    }

    public function getListWhere(
        array      $orderBy = [],
        string     $searchValue = null,
        array      $filters = [], array $relations = [],
        int|string $dataLimit = DEFAULT_DATA_LIMIT,
        int        $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->faq->when($searchValue, function ($query) use ($searchValue) {
                    return $query->where('question', 'like', "%$searchValue%");
                })
                ->when(!empty($orderBy), function ($query) use ($orderBy) {
                    $query->orderBy(array_key_first($orderBy),array_values($orderBy)[0]);
                });

        $filters += ['searchValue' =>$searchValue];
        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit)->appends($filters);
    }

    public function update(string $id, array $data): bool
    {
        return $this->faq->where('id', $id)->update($data);
    }

    public function delete(array $params): bool
    {
        $this->faq->where($params)->delete();
        return true;
    }
}
