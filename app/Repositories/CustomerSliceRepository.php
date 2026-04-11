<?php

namespace App\Repositories;

use App\Contracts\Repositories\CustomerSliceRepositoryInterface;
use App\Models\CustomerSlice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerSliceRepository implements CustomerSliceRepositoryInterface
{
    public function __construct(
        private readonly CustomerSlice $customerSlice,
    )
    {
    }

    public function add(array $data): string|object
    {
        return $this->customerSlice->create($data);
    }

    public function getFirstWhere(array $params, array $relations = []): ?Model
    {
        return $this->customerSlice->with($relations)->where($params)->first();
    }

    public function getList(array $orderBy = [], array $relations = [], int|string $dataLimit = DEFAULT_DATA_LIMIT, int $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->customerSlice->with($relations)
                ->when(!empty($orderBy), function ($query) use ($orderBy) {
                    return $query->orderBy(array_key_first($orderBy),array_values($orderBy)[0]);
                });

        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit);
    }

    public function getListWhere(array $orderBy = [], string $searchValue = null, array $filters = [], array $relations = [], int|string $dataLimit = DEFAULT_DATA_LIMIT, int $offset = null): Collection|LengthAwarePaginator
    {
        $query = $this->customerSlice
            ->with($relations)
            ->when($searchValue, function ($query) use($searchValue){
                $query->where('name', 'like', "%{$searchValue}%");
            })
            ->when(isset($filters['status']) , function ($query) use ($filters){
                return $query->where(['status' => $filters['status']]);
            })
            ->when(!empty($orderBy), function ($query) use ($orderBy) {
                $query->orderBy(key($orderBy),current($orderBy));
            });

        $filters += ['searchValue' =>$searchValue];
        return $dataLimit == 'all' ? $query->get() : $query->paginate($dataLimit)->appends($filters);
    }

    public function update(string $id, array $data): bool
    {
        return $this->customerSlice->where('id', $id)->update($data);
    }

    public function updateWhere(array $params, array $data): bool
    {
        $this->customerSlice->where($params)->update($data);
        return true;
    }


    public function delete(array $params): bool
    {
        $this->customerSlice->where($params)->delete();
        return true;
    }
}
