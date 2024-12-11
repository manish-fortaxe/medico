<?php

namespace App\Http\Controllers\Admin\Product;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\TranslationRepositoryInterface;
use App\Enums\ExportFileNames\Admin\Tag as TagExport;
use App\Enums\ViewPaths\Admin\Tag;
use App\Exports\BrandListExport;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\TagAddRequest;
use App\Http\Requests\Admin\TagUpdateRequest;
use App\Models\Tag as ModelsTag;
use App\Services\TagService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TagController extends BaseController
{
    public function __construct(
        private readonly TagRepositoryInterface           $tagRepo,
        private readonly ProductRepositoryInterface           $productRepo,
        private readonly TranslationRepositoryInterface     $translationRepo,
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
        return $this->getList($request);
    }

    public function getList(Request $request): Application|Factory|View
    {
        $tags = ModelsTag::paginate(getWebConfig(name: 'pagination_limit'));
        return view(Tag::LIST[VIEW], compact('tags'));
    }

    public function getAddView(): View
    {
        $language = getWebConfig(name: 'pnc_language') ?? null;
        $defaultLanguage = $language[0];
        return view(Tag::ADD[VIEW], compact( 'language', 'defaultLanguage'));
    }

    public function getUpdateView(string|int $id): View|RedirectResponse
    {
        $tag = ModelsTag::find($id);
        $language = getWebConfig(name: 'pnc_language') ?? null;
        $defaultLanguage = $language[0];
        return view(Tag::UPDATE[VIEW], compact('tag', 'language', 'defaultLanguage'));
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $data = [
          'status' => $request->get('status', 0),
        ];
        $this->tagRepo->update(id:$request['id'], data:$data);
        return response()->json(['success' => 1, 'message' => translate('status_updated_successfully')], 200);
    }

    public function delete(Request $request, TagService $brandService): RedirectResponse
    {
        ModelsTag::find($request['id'])->delete();
        Toastr::success(translate('tag_deleted_successfully'));
        return redirect()->back();
    }


    public function add(TagAddRequest $request, TagService $tagService): RedirectResponse
    {
        $dataArray = $tagService->getAddData(request:$request);
        $savedAttributes = $this->tagRepo->add(data:$dataArray);

        Toastr::success(translate('tag_added_successfully'));
        return redirect()->route('admin.tag.list');
    }

    public function update(TagUpdateRequest $request, $id, TagService $tagService): RedirectResponse
    {
        $tag = ModelsTag::find($id);
        $dataArray = $tagService->getUpdateData(request: $request, data:$tag);
        ModelsTag::where('id', $id)->update($dataArray);

        Toastr::success(translate('tag_updated_successfully'));
        return redirect()->route('admin.tag.list');
    }

}
