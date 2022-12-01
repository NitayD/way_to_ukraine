<?php

namespace App\Http\Controllers;

use App\Models\Fundraising;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function main()
    {
        $funds = Fundraising::main()->get();
        $blocks = \App\Models\ContentCategory::all();
        $reqs = \App\Models\RequisiteGroup::all();
        return view('welcome', [
            'funds' => $funds,
            'blocks' => $blocks,
            'reqs' => $reqs,
        ]);
    }
}
