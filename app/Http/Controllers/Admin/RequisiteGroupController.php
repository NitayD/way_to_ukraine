<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRequisiteGroupRequest;
use App\Http\Requests\StoreRequisiteGroupRequest;
use App\Http\Requests\UpdateRequisiteGroupRequest;
use App\Models\RequisiteGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequisiteGroupController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('requisite_group_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RequisiteGroup::query()->select(sprintf('%s.*', (new RequisiteGroup())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'requisite_group_show';
                $editGate = 'requisite_group_edit';
                $deleteGate = 'requisite_group_delete';
                $crudRoutePart = 'requisite-groups';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('priority', function ($row) {
                return $row->priority ? $row->priority : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.requisiteGroups.index');
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
