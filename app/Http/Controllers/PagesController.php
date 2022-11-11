<?php

namespace App\Http\Controllers;

use App\Models\ContentCategory;
use App\Models\ContentPage;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function category(Request $req, string $category)
    {
        $cat = ContentCategory::where('slug', $category)->orWhere('id', $category)->first();
        return view('category', [
            'category' => $cat,
            'list' => $cat->pages()->paginate(3)
        ]);
    }
    public function page(Request $req, string $category, ContentPage $page)
    {
        return view('page', [
            'category' => ContentCategory::where('slug', $category)->first(),
            'page' => $page
        ]);
    }
}
