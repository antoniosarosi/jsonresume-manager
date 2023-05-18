<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResume;
use App\Models\Publish;
use App\Models\Resume;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class ResumeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $resumes = auth()->user()->resumes;
        return view('resumes/index', compact('resumes'));
    }

    private function savePicture(string $blob) : string {
        $img = Image::make($blob);
        $fileName = Str::uuid() . '.' . array_slice(explode('/', $img->mime()), -1)[0];
        $filePath = "/storage/images/{$fileName}";
        $img->save(public_path($filePath));

        return $filePath;
    }

    public function create() {
        $resume = json_encode(Resume::factory()->make());
        return view('resumes/create', compact('resume'));
//        return view('resumes/create');
    }

    public function store(StoreResume $request) {
        $data = $request->validated();
        $picture = $data['content']['basics']['picture'];
        if ($picture !== '/storage/images/default.png') {
            $data['content']['basics']['picture'] = $this->savePicture($picture);
        }
        $resume = auth()->user()->resumes()->create($data);

        Session::flash('alert', [
            'type' => 'success',
            'messages' => ["Resume {$resume->title} created"],
        ]);
        return response($resume, Response::HTTP_CREATED);
    }

    public function edit(Resume $resume) {
        $this->authorize('update', $resume);
        return view("resumes/edit", ['resume' => json_encode($resume)]);
    }

    public function update(StoreResume $request, Resume $resume) {
        $data = $request->validated();
        $this->authorize('update', $resume);
        $picture = $data['content']['basics']['picture'];
        if ($resume->content['basics']['picture'] !== $picture) {
            $data['content']['basics']['picture'] = $this->savePicture($picture);
        }

        $resume->update($data);

        Session::flash('alert', [
            'type' => 'success',
            'messages' => ["Resume {$resume->title} updated"],
        ]);

        return response(status: Response::HTTP_OK);
    }

    public function destroy(Resume $resume) {
        $this->authorize('delete', $resume);

        try {
            $resume->delete();
        } catch (QueryException $e) {
            $publish = Publish::where('resume_id', $resume->id)->first();
            return redirect(route('resumes.index'))->with('alert', [
                'type' => 'danger',
                'messages' => ["
                    Resume {$resume->title} cannot be deleted because publish
                    <a href='{$publish->url}'>{$publish->url}</a> is using it!
                    Delete the publish first.
                "]
            ]);
        }
        return redirect(route('resumes.index'))->with('alert', [
            'type' => 'danger',
            'messages' => ["Resume {$resume->title} deleted"]
        ]);
    }
}
