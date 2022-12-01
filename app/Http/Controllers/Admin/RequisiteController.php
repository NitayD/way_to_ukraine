<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRequisiteRequest;
use App\Http\Requests\StoreRequisiteRequest;
use App\Http\Requests\UpdateRequisiteRequest;
use App\Models\Requisite;
use App\Models\RequisiteGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequisiteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('requisite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisites = Requisite::with(['group'])->get();

        return view('admin.requisites.index', compact('requisites'));
    }

    public function create()
    {
        abort_if(Gate::denies('requisite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = RequisiteGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.requisites.create', compact('groups'));
    }

    public function store(StoreRequisiteRequest $request)
    {
        $requisite = Requisite::create($request->all());

        return redirect()->route('admin.requisites.index');
    }

    public function edit(Requisite $requisite)
    {
        abort_if(Gate::denies('requisite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $groups = RequisiteGroup::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $requisite->load('group');

        return view('admin.requisites.edit', compact('groups', 'requisite'));
    }

    public function update(UpdateRequisiteRequest $request, Requisite $requisite)
    {
        $requisite->update($request->all());

        return redirect()->route('admin.requisites.index');
    }

    public function show(Requisite $requisite)
    {
        abort_if(Gate::denies('requisite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisite->load('group');

        return view('admin.requisites.show', compact('requisite'));
    }

    public function destroy(Requisite $requisite)
    {
        abort_if(Gate::denies('requisite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisite->delete();

        return back();
    }

    public function massDestroy(MassDestroyRequisiteRequest $request)
    {
        Requisite::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
