<?php

namespace App\Http\Controllers\Admin\Product;

use App\Contracts\Repositories\DepartmentRepositoryInterface;
use App\Enums\ViewPaths\Admin\Department;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Traits\PaginatorTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;

class DepartmentController extends BaseController
{
    use PaginatorTrait;

    public function __construct(
        private readonly DepartmentRepositoryInterface       $departmentRepo,
    )
    {
    }

    /**
     * @param Request|null $request
     * @param string|null $type
     * @return View Index function is the starting point of a controller
     * Index function is the starting point of a controller
     */
    public function index(Request|null $request, string $type = null): View
    {
        return $this->getAddView($request);
    }

    public function getList(): JsonResponse
    {
        $departments = $this->departmentRepo->getList(dataLimit: 'all');
        return response()->json(DepartmentResource::collection($departments));
    }

    public function getAddView(Request $request): View
    {
        $departments = $this->departmentRepo->getListWhere(searchValue: $request->get('searchValue'), dataLimit: getWebConfig(name: 'pagination_limit'));
        return view(Department::LIST[VIEW], compact('departments'));
    }

    public function getUpdateView(string|int $id): View
    {
        $department = $this->departmentRepo->getFirstWhere(params:['id'=>$id], relations: []);
        return view(Department::UPDATE[VIEW], compact('department'));
    }

    public function add(DepartmentRequest $request): JsonResponse|RedirectResponse
    {
        $dataArray = [
            'name' => $request['name'],
            'sequence' => $request['sequence'],
            'slug' => $this->getSlug($request)
        ];

        $this->departmentRepo->add(data:$dataArray);

        Toastr::success(translate('department_added_successfully'));
        return back();
    }

    public function update(DepartmentRequest $request): RedirectResponse
    {
        $dataArray = [
            'name' => $request['name'],
            'sequence' => $request['sequence'],
            'slug' => $this->getSlug($request)
        ];

        $this->departmentRepo->update(id:$request['id'], data:$dataArray);

        Toastr::success(translate('department_updated_successfully'));
        return back();
    }

    public function delete(Request $request): JsonResponse
    {
        $this->departmentRepo->delete(params:['id'=>$request['id']]);
        return response()->json(['message'=> translate('department_deleted_successfully')]);
    }

    public function getSlug(object $request): string
    {
        return Str::slug($request['name']) . '-' . Str::random(6);
    }

}
