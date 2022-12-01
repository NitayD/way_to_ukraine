<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRequisiteGroupRequest;
use App\Http\Requests\StoreRequisiteGroupRequest;
use App\Http\Requests\UpdateRequisiteGroupRequest;
use App\Models\RequisiteGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequisiteGroupController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('requisite_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisiteGroups = RequisiteGroup::all();

        return view('admin.requisiteGroups.index', compact('requisiteGroups'));
    }

    public function create()
    {
        abort_if(Gate::denies('requisite_group_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requisiteGroups.create');
    }

    public function store(StoreRequisiteGroupRequest $request)
    {
        $requisiteGroup = RequisiteGroup::create($request->all());

        return redirect()->route('admin.requisite-groups.index');
    }

    public function edit(RequisiteGroup $requisiteGroup)
    {
        abort_if(Gate::denies('requisite_group_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.requisiteGroups.edit', compact('requisiteGroup'));
    }

    public function update(UpdateRequisiteGroupRequest $request, RequisiteGroup $requisiteGroup)
    {
        $requisiteGroup->update($request->all());

        return redirect()->route('admin.requisite-groups.index');
    }

    public function show(RequisiteGroup $requisiteGroup)
    {
        abort_if(Gate::denies('requisite_group_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisiteGroup->load('groupRequisites');

        return view('admin.requisiteGroups.show', compact('requisiteGroup'));
    }

    public function destroy(RequisiteGroup $requisiteGroup)
    {
        abort_if(Gate::denies('requisite_group_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $requisiteGroup->delete();

        return back();
    }

    public function massDestroy(MassDestroyRequisiteGroupRequest $request)
    {
        RequisiteGroup::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
