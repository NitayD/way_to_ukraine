<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContentPageRequest;
use App\Http\Requests\StoreContentPageRequest;
use App\Http\Requests\UpdateContentPageRequest;
use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\Fundraising;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContentPageController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('content_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContentPage::with(['categories', 'aid'])->select(sprintf('%s.*', (new ContentPage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'content_page_show';
                $editGate = 'content_page_edit';
                $deleteGate = 'content_page_delete';
                $crudRoutePart = 'content-pages';

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
            $table->editColumn('visible', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->visible ? 'checked' : null) . '>';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('excerpt', function ($row) {
                return $row->excerpt ? $row->excerpt : '';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('featured_image', function ($row) {
                if ($photo = $row->featured_image) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->addColumn('aid_title', function ($row) {
                return $row->aid ? $row->aid->title : '';
            });

            $table->editColumn('aid.description_short', function ($row) {
                return $row->aid ? (is_string($row->aid) ? $row->aid : $row->aid->description_short) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'visible', 'category', 'featured_image', 'aid']);

            return $table->make(true);
        }

        return view('admin.contentPages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('content_page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');

        $aids = Fundraising::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.contentPages.create', compact('aids', 'categories'));
    }

    public function store(StoreContentPageRequest $request)
    {
        $contentPage = ContentPage::create($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        if ($request->input('featured_image', false)) {
            $contentPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        foreach ($request->input('images', []) as $file) {
            $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contentPage->id]);
        }

        return redirect()->route('admin.content-pages.index');
    }

    public function edit(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');

        $aids = Fundraising::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contentPage->load('categories', 'aid');

        return view('admin.contentPages.edit', compact('aids', 'categories', 'contentPage'));
    }

    public function update(UpdateContentPageRequest $request, ContentPage $contentPage)
    {
        $contentPage->update($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        if ($request->input('featured_image', false)) {
            if (!$contentPage->featured_image || $request->input('featured_image') !== $contentPage->featured_image->file_name) {
                if ($contentPage->featured_image) {
                    $contentPage->featured_image->delete();
                }
                $contentPage->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($contentPage->featured_image) {
            $contentPage->featured_image->delete();
        }

        if (count($contentPage->images) > 0) {
            foreach ($contentPage->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contentPage->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.content-pages.index');
    }

    public function show(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentPage->load('categories', 'aid');

        return view('admin.contentPages.show', compact('contentPage'));
    }

    public function destroy(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentPage->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentPageRequest $request)
    {
        ContentPage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('content_page_create') && Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContentPage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
