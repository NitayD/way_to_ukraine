<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRequisiteRequest;
use App\Http\Requests\StoreRequisiteRequest;
use App\Http\Requests\UpdateRequisiteRequest;
use App\Models\Requisite;
use App\Models\RequisiteGroup;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RequisiteController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('requisite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Requisite::with(['group'])->select(sprintf('%s.*', (new Requisite())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'requisite_show';
                $editGate = 'requisite_edit';
                $deleteGate = 'requisite_delete';
                $crudRoutePart = 'requisites';

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
            $table->editColumn('label', function ($row) {
                return $row->label ? $row->label : '';
            });
            $table->editColumn('value', function ($row) {
                return $row->value ? $row->value : '';
            });
            $table->editColumn('priority', function ($row) {
                return $row->priority ? $row->priority : '';
            });
            $table->addColumn('group_name', function ($row) {
                return $row->group ? $row->group->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'group']);

            return $table->make(true);
        }

        return view('admin.requisites.index');
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
