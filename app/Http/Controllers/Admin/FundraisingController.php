<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFundraisingRequest;
use App\Http\Requests\StoreFundraisingRequest;
use App\Http\Requests\UpdateFundraisingRequest;
use App\Models\Fundraising;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FundraisingController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('fundraising_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Fundraising::query()->select(sprintf('%s.*', (new Fundraising())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'fundraising_show';
                $editGate = 'fundraising_edit';
                $deleteGate = 'fundraising_delete';
                $crudRoutePart = 'fundraisings';

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
            $table->editColumn('finished', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->finished ? 'checked' : null) . '>';
            });
            $table->editColumn('already_collected', function ($row) {
                return $row->already_collected ? $row->already_collected : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('description_short', function ($row) {
                return $row->description_short ? $row->description_short : '';
            });
            $table->editColumn('files', function ($row) {
                if (!$row->files) {
                    return '';
                }
                $links = [];
                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('sort', function ($row) {
                return $row->sort ? $row->sort : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'finished', 'files']);

            return $table->make(true);
        }

        return view('admin.fundraisings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fundraising_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fundraisings.create');
    }

    public function store(StoreFundraisingRequest $request)
    {
        $fundraising = Fundraising::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $fundraising->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        foreach ($request->input('gallary', []) as $file) {
            $fundraising->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallary');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $fundraising->id]);
        }

        return redirect()->route('admin.fundraisings.index');
    }

    public function edit(Fundraising $fundraising)
    {
        abort_if(Gate::denies('fundraising_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fundraisings.edit', compact('fundraising'));
    }

    public function update(UpdateFundraisingRequest $request, Fundraising $fundraising)
    {
        $fundraising->update($request->all());

        if (count($fundraising->files) > 0) {
            foreach ($fundraising->files as $media) {
                if (!in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $fundraising->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $fundraising->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        if (count($fundraising->gallary) > 0) {
            foreach ($fundraising->gallary as $media) {
                if (!in_array($media->file_name, $request->input('gallary', []))) {
                    $media->delete();
                }
            }
        }
        $media = $fundraising->gallary->pluck('file_name')->toArray();
        foreach ($request->input('gallary', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $fundraising->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallary');
            }
        }

        return redirect()->route('admin.fundraisings.index');
    }

    public function show(Fundraising $fundraising)
    {
        abort_if(Gate::denies('fundraising_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fundraising->load('funraisingPurchasingLists');

        return view('admin.fundraisings.show', compact('fundraising'));
    }

    public function destroy(Fundraising $fundraising)
    {
        abort_if(Gate::denies('fundraising_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fundraising->delete();

        return back();
    }

    public function massDestroy(MassDestroyFundraisingRequest $request)
    {
        Fundraising::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('fundraising_create') && Gate::denies('fundraising_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Fundraising();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
