<?php

namespace App\Http\Controllers\Web;

use App\Utils\CategoryManager;
use App\Utils\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Molecule;
use App\Models\MoleculeFAQ;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MoleculeListController extends Controller
{
    public function molecules(Request $request)
    {
        $themeName = theme_root_path();

        return match ($themeName) {
            'default' => self::default_theme($request)
        };
    }

    public function default_theme($request): View|JsonResponse|Redirector|RedirectResponse
    {
        $molecules = Molecule::get();

        $groupedMolecules = $molecules->groupBy(function ($molecule) {
            return strtoupper(substr($molecule->tag, 0, 1)); // Group by the first letter (uppercase)
        });

        // Sort groups alphabetically
        $groupedMolecules = $groupedMolecules->sortKeys();

        return view(VIEW_FILE_NAMES['molecule_list_page'], [
            'groupedMolecules' => $groupedMolecules,
        ]);
    }

    function singleMolecule($slug)
    {
        $molecule = Molecule::where('slug',$slug)->first();
        $faqs = MoleculeFAQ::where('tag_id', $molecule->id)->get();
        return view(VIEW_FILE_NAMES['molecule_view_page'], [
            'molecule' => $molecule, 'faqs' => $faqs
        ]);
    }

}
