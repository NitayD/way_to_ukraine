<?php

namespace App\Http\Controllers;

use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\Fundraising;
use App\Models\PurchasingList;
use App\Models\Requisite;
use App\Models\RequisiteGroup;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main()
    {
        $funds = Fundraising::main()->get();
        $blocks = ContentCategory::all();
        $reqs = RequisiteGroup::all();
        return view('welcome', [
            'funds' => $funds,
            'blocks' => $blocks,
            'reqs' => $reqs,
        ]);
    }

    public function category(ContentCategory $category)
    {
        return view('category', [
            'category' => $category,
        ]);
    }

    public function page(ContentPage $page)
    {
        return view('page', [
            'page' => $page,
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function requisites()
    {
        return view('requisites', [
            Requisite::all()
        ]);
    }

    public function fundraisers()
    {
        return view('list', [
            'title' => 'Актуальные сборы',
            'itemType' => 'fundraising',
            'list' => Fundraising::main()->get()
        ]);
    }

    public function fundraising(Fundraising $fundraising)
    {
        return view('fundraising', [
            'data' => $fundraising,
        ]);
    }
}
