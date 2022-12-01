<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPurchasingListRequest;
use App\Http\Requests\StorePurchasingListRequest;
use App\Http\Requests\UpdatePurchasingListRequest;
use App\Models\Collectible;
use App\Models\Fundraising;
use App\Models\PurchasingList;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchasingListController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchasing_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchasingLists = PurchasingList::with(['funraising', 'item'])->get();

        return view('admin.purchasingLists.index', compact('purchasingLists'));
    }

    public function create()
    {
        abort_if(Gate::denies('purchasing_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funraisings = Fundraising::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = Collectible::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.purchasingLists.create', compact('funraisings', 'items'));
    }

    public function store(StorePurchasingListRequest $request)
    {
        $purchasingList = PurchasingList::create($request->all());

        return redirect()->route('admin.purchasing-lists.index');
    }

    public function edit(PurchasingList $purchasingList)
    {
        abort_if(Gate::denies('purchasing_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $funraisings = Fundraising::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = Collectible::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $purchasingList->load('funraising', 'item');

        return view('admin.purchasingLists.edit', compact('funraisings', 'items', 'purchasingList'));
    }

    public function update(UpdatePurchasingListRequest $request, PurchasingList $purchasingList)
    {
        $purchasingList->update($request->all());

        return redirect()->route('admin.purchasing-lists.index');
    }

    public function show(PurchasingList $purchasingList)
    {
        abort_if(Gate::denies('purchasing_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchasingList->load('funraising', 'item');

        return view('admin.purchasingLists.show', compact('purchasingList'));
    }

    public function destroy(PurchasingList $purchasingList)
    {
        abort_if(Gate::denies('purchasing_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchasingList->delete();

        return back();
    }

    public function massDestroy(MassDestroyPurchasingListRequest $request)
    {
        PurchasingList::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
