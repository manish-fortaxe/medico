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
        $categories = CategoryManager::getCategoriesWithCountingAndPriorityWiseSorting();
        $blogsSortBy = $request->get('sort_by');

        $blogsListData = Blog::get();

        if ($blogsSortBy) {
            if ($blogsSortBy == 'latest') {
                $blogsListData = $blogsListData->sortByDesc('id');
            } elseif ($blogsSortBy == 'low-high') {
                $blogsListData = $blogsListData->sortBy('unit_price');
            } elseif ($blogsSortBy == 'high-low') {
                $blogsListData = $blogsListData->sortByDesc('unit_price');
            } elseif ($blogsSortBy == 'a-z') {
                $blogsListData = $blogsListData->sortBy('name');
            } elseif ($blogsSortBy == 'z-a') {
                $blogsListData = $blogsListData->sortByDesc('name');
            }
        }

        $blogs = $blogsListData->paginate(20);

        return view(VIEW_FILE_NAMES['blogs_list_page'], [
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }

    function singleMolecule($slug)
    {
        $molecule = Tag::where('slug',$slug)->first();
        $faqs = MoleculeFAQ::where('tag_id', $molecule->id)->get();
        return view(VIEW_FILE_NAMES['molecule_view_page'], [
            'molecule' => $molecule, 'faqs' => $faqs
        ]);
    }

}
