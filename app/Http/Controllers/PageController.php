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
        $reqs = RequisiteGroup::wReqs()->get();
        return view('welcome', [
            'funds' => $funds,
            'blocks' => $blocks,
            'reqs' => $reqs,
            'nogroup' => Requisite::nogroup()->get(),
        ]);
    }

    public function category(ContentCategory $category)
    {
        return view('list', [
            'title' => $category->name,
            'list' => $category->pages()->where('visible', true)->orderby('created_at', 'desc')->get(),
            'itemType' => 'page',
        ]);
    }

    public function page(ContentPage $page)
    {
        return view('page', [
            'data' => $page,
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function team()
    {
        return view('team');
    }

    public function requisites()
    {
        return view('requisites', [
            'reqs' => RequisiteGroup::wReqs()->get(),
            'nogroup' => Requisite::nogroup()->get(),
            'founders' => Fundraising::where('finished', false)->get()
        ]);
    }

    public function fundraisers()
    {
        return view('list', [
            'title' => trans('welcome.donation.title'),
            'itemType' => 'fundraising',
            'list' => Fundraising::main()->orderby('created_at', 'desc')->get()
        ]);
    }

    public function fundraising(Fundraising $fundraising)
    {
        return view('fundraising', [
            'data' => $fundraising,
        ]);
    }
}
