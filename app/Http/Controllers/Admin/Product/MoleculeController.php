<?php

namespace App\Http\Controllers\Admin\Product;

use App\Contracts\Repositories\MoleculeRepositoryInterface;
use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Contracts\Repositories\TranslationRepositoryInterface;
use App\Enums\ViewPaths\Admin\Molecule;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\MoleculeAddRequest;
use App\Http\Requests\Admin\MoleculeUpdateRequest;
use App\Models\Molecule as ModelsMolecule;
use App\Services\MoleculeService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MoleculeController extends BaseController
{
    public function __construct(
        private readonly MoleculeRepositoryInterface           $moleculeRepo,
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
        $molecules = ModelsMolecule::paginate(getWebConfig(name: 'pagination_limit'));
        return view(Molecule::LIST[VIEW], compact('molecules'));
    }

    public function getAddView(): View
    {
        $language = getWebConfig(name: 'pnc_language') ?? null;
        $defaultLanguage = $language[0];
        return view(Molecule::ADD[VIEW], compact( 'language', 'defaultLanguage'));
    }

    public function getUpdateView(string|int $id): View|RedirectResponse
    {
        $molecule = ModelsMolecule::find($id);
        $language = getWebConfig(name: 'pnc_language') ?? null;
        $defaultLanguage = $language[0];
        return view(Molecule::UPDATE[VIEW], compact('molecule', 'language', 'defaultLanguage'));
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $data = [
          'status' => $request->get('status', 0),
        ];
        $this->moleculeRepo->update(id:$request['id'], data:$data);
        return response()->json(['success' => 1, 'message' => translate('status_updated_successfully')], 200);
    }

    public function delete(Request $request, MoleculeService $moleculeService): RedirectResponse
    {
        ModelsMolecule::find($request['id'])->delete();
        Toastr::success(translate('molecule_deleted_successfully'));
        return redirect()->back();
    }


    public function add(MoleculeAddRequest $request, MoleculeService $moleculeService): RedirectResponse
    {
        $dataArray = $moleculeService->getAddData(request:$request);
        $savedAttributes = $this->moleculeRepo->add(data:$dataArray);

        Toastr::success(translate('molecule_added_successfully'));
        return redirect()->route('admin.molecule.list');
    }

    public function update(MoleculeUpdateRequest $request, $id, MoleculeService $moleculeService): RedirectResponse
    {
        $tag = ModelsMolecule::find($id);
        $dataArray = $moleculeService->getUpdateData(request: $request, data:$tag);
        ModelsMolecule::where('id', $id)->update($dataArray);

        Toastr::success(translate('molecule_updated_successfully'));
        return redirect()->route('admin.molecule.list');
    }

}
