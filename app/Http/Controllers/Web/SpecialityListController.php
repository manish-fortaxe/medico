<?php

namespace App\Http\Controllers\Web;

use App\Utils\CategoryManager;
use App\Utils\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\MoleculeFAQ;
use App\Models\Tag;
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

class SpecialityListController extends Controller
{
    public function speciality(Request $request)
    {
        $themeName = theme_root_path();

        return match ($themeName) {
            'default' => self::default_theme($request)
        };
    }

    public function default_theme($request): View|JsonResponse|Redirector|RedirectResponse
    {
        $molecules = Tag::get();

        $groupedMolecules = $molecules->groupBy(function ($molecule) {
            return strtoupper(substr($molecule->tag, 0, 1)); // Group by the first letter (uppercase)
        });

        // Sort groups alphabetically
        $groupedMolecules = $groupedMolecules->sortKeys();

        return view(VIEW_FILE_NAMES['speciality_list_page'], [
            'groupedMolecules' => $groupedMolecules,
        ]);
    }

    function singleSpeciality($slug)
    {
        $speciality = Tag::where('slug',$slug)->first();
        return view(VIEW_FILE_NAMES['speciality_view_page'], [
            'speciality' => $speciality
        ]);
    }

}
