<?php

namespace App\Http\Controllers\Admin\Product;

use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Enums\ViewPaths\Admin\Author;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Services\AuthorService;
use App\Traits\PaginatorTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;

class AuthorController extends BaseController
{
    use PaginatorTrait;

    public function __construct(
        private readonly AuthorRepositoryInterface       $authorRepo,
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
        $authors = $this->authorRepo->getList(dataLimit: 'all');
        dd($authors);
        return response()->json(AuthorResource::collection($authors));
    }

    public function getAddView(Request $request): View
    {
        $authors = $this->authorRepo->getListWhere(searchValue: $request->get('searchValue'), dataLimit: getWebConfig(name: 'pagination_limit'));
        return view(Author::LIST[VIEW], compact('authors'));
    }

    public function getUpdateView(string|int $id): View
    {
        $author = $this->authorRepo->getFirstWhere(params:['id'=>$id], relations: []);
        return view(Author::UPDATE[VIEW], compact('author'));
    }

    public function add(AuthorRequest $request, AuthorService $authorService): JsonResponse|RedirectResponse
    {
        $dataArray = $authorService->getAddData(request:$request);
        $this->authorRepo->add(data:$dataArray);

        Toastr::success(translate('author_added_successfully'));
        return back();
    }

    public function update(AuthorRequest $request, AuthorService $authorService): RedirectResponse
    {
        $author = $this->authorRepo->getFirstWhere(params:['id'=>$request['id']],relations: ['storage']);
        $dataArray = $authorService->getUpdateData(request: $request, data:$author);

        $this->authorRepo->update(id:$request['id'], data:$dataArray);

        Toastr::success(translate('author_updated_successfully'));
        return back();
    }

    public function delete(Request $request): JsonResponse
    {
        $this->authorRepo->delete(params:['id'=>$request['id']]);
        return response()->json(['message'=> translate('author_deleted_successfully')]);
    }

    public function getSlug(object $request): string
    {
        return Str::slug($request['name']);
    }

}
