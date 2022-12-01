<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCollectibleRequest;
use App\Http\Requests\StoreCollectibleRequest;
use App\Http\Requests\UpdateCollectibleRequest;
use App\Models\Collectible;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CollectibleController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('collectible_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $collectibles = Collectible::with(['media'])->get();

        return view('admin.collectibles.index', compact('collectibles'));
    }

    public function create()
    {
        abort_if(Gate::denies('collectible_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.collectibles.create');
    }

    public function store(StoreCollectibleRequest $request)
    {
        $collectible = Collectible::create($request->all());

        foreach ($request->input('photo', []) as $file) {
            $collectible->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        foreach ($request->input('file', []) as $file) {
            $collectible->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $collectible->id]);
        }

        return redirect()->route('admin.collectibles.index');
    }

    public function edit(Collectible $collectible)
    {
        abort_if(Gate::denies('collectible_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.collectibles.edit', compact('collectible'));
    }

    public function update(UpdateCollectibleRequest $request, Collectible $collectible)
    {
        $collectible->update($request->all());

        if (count($collectible->photo) > 0) {
            foreach ($collectible->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $collectible->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $collectible->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        if (count($collectible->file) > 0) {
            foreach ($collectible->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $collectible->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $collectible->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.collectibles.index');
    }

    public function show(Collectible $collectible)
    {
        abort_if(Gate::denies('collectible_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $collectible->load('itemPurchasingLists');

        return view('admin.collectibles.show', compact('collectible'));
    }

    public function destroy(Collectible $collectible)
    {
        abort_if(Gate::denies('collectible_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $collectible->delete();

        return back();
    }

    public function massDestroy(MassDestroyCollectibleRequest $request)
    {
        Collectible::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('collectible_create') && Gate::denies('collectible_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Collectible();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
