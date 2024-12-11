<?php

namespace App\Http\Controllers\Admin\Product;

use App\Contracts\Repositories\MoleculeFAQRepositoryInterface;
use App\Enums\ViewPaths\Admin\MoleculeFAQ;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\MoleculeFAQRequest;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\MoleculeFAQResource;
use App\Models\Tag;
use App\Traits\PaginatorTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MoleculeFAQController extends BaseController
{
    use PaginatorTrait;

    public function __construct(
        private readonly MoleculeFAQRepositoryInterface       $moleculeFaqRepo,
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
        $faqs = $this->moleculeFaqRepo->getList(dataLimit: 'all');
        return response()->json(MoleculeFAQResource::collection($faqs));
    }

    public function getAddView(Request $request): View
    {
        $faqs = $this->moleculeFaqRepo->getListWhere(searchValue: $request->get('searchValue'), dataLimit: getWebConfig(name: 'pagination_limit'));
        return view(MoleculeFAQ::LIST[VIEW], compact('faqs'));
    }

    public function getUpdateView(string|int $id): View
    {
        $faq = $this->moleculeFaqRepo->getFirstWhere(params:['id'=>$id], relations: []);
        return view(MoleculeFAQ::UPDATE[VIEW], compact('faq'));
    }

    public function add(MoleculeFAQRequest $request): JsonResponse|RedirectResponse
    {
        $dataArray = [
            'tag_id' => $request['tag_id'],
            'question' => $request['question'],
            'answer' => $request['answer']
        ];

        $savedFaq = $this->moleculeFaqRepo->add(data:$dataArray);

        Toastr::success(translate('faq_added_successfully'));
        return back();
    }

    public function update(MoleculeFAQRequest $request): RedirectResponse
    {
        $dataArray = [
            'tag_id' => $request['tag_id'],
            'question' => $request['question'],
            'answer' => $request['answer'],
        ];

        $this->moleculeFaqRepo->update(id:$request['id'], data:$dataArray);

        Toastr::success(translate('faq_updated_successfully'));
        return back();
    }

    public function delete(Request $request): JsonResponse
    {
        $this->moleculeFaqRepo->delete(params:['id'=>$request['id']]);
        return response()->json(['message'=> translate('faq_deleted_successfully')]);
    }

}
