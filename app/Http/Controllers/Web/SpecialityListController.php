<?php

namespace App\Http\Controllers\Web;

use App\Utils\CategoryManager;
use App\Utils\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Department;
use App\Models\MoleculeFAQ;
use App\Models\Product;
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
        if($request->type){
            $selected_department = Department::where('slug', $request->type)->first();
        }
        $departments = Department::get();
        $products = Product::where('department_id', $selected_department->id ?? 1)->paginate(10);
        return view(VIEW_FILE_NAMES['speciality_list_page'], [
            'departments' => $departments,
            'products' => $products
        ]);
    }

    function singleSpeciality($slug)
    {
        $department = Department::where('slug', $slug)->first();
        $products = Product::where('department_id',$department->id)->paginate(20);
        return view(VIEW_FILE_NAMES['speciality_view_page'], [
            'products' => $products
        ]);
    }

}
