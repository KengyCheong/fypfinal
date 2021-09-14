<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIllnessTagRequest;
use App\Http\Requests\StoreIllnessTagRequest;
use App\Http\Requests\UpdateIllnessTagRequest;
use App\Models\IllnessTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IllnessTagsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('illness_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $illnessTags = IllnessTag::all();

        return view('frontend.illnessTags.index', compact('illnessTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('illness_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.illnessTags.create');
    }

    public function store(StoreIllnessTagRequest $request)
    {
        $illnessTag = IllnessTag::create($request->all());

        return redirect()->route('frontend.illness-tags.index');
    }

    public function edit(IllnessTag $illnessTag)
    {
        abort_if(Gate::denies('illness_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.illnessTags.edit', compact('illnessTag'));
    }

    public function update(UpdateIllnessTagRequest $request, IllnessTag $illnessTag)
    {
        $illnessTag->update($request->all());

        return redirect()->route('frontend.illness-tags.index');
    }

    public function show(IllnessTag $illnessTag)
    {
        abort_if(Gate::denies('illness_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.illnessTags.show', compact('illnessTag'));
    }

    public function destroy(IllnessTag $illnessTag)
    {
        abort_if(Gate::denies('illness_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $illnessTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyIllnessTagRequest $request)
    {
        IllnessTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
