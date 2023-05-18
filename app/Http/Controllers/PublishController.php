<?php

namespace App\Http\Controllers;

use App\Mail\ResumePublished;
use App\Models\Resume;
use App\Models\Publish;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PublishController extends Controller {
    private $rules = [
        'resume_id' => 'required|numeric',
        'theme_id' => 'required|numeric',
        'visibility' => 'nullable|string',
    ];

    public function __construct() {
        $this->middleware('auth', ['except' => 'show']);
        $this->jsonResumeAPi = config('services.jsonresume.api');
    }

    public function show(Publish $publish) {
        if ($publish->visibility === 'private') {
            if (!auth()->check()) {
                return redirect(route('login'));
            }
            if (auth()->user()->id !== $publish->user_id) {
                abort(Response::HTTP_FORBIDDEN);
            }
        }

        return $this->render($publish->resume, $publish->theme);
    }

    public function index() {
        $publishes = auth()->user()->publishes;

        return view('publishes/index', compact('publishes'));
    }

    public function preview(Request $request) {
        $data = $request->validate($this->rules);
        $theme = Theme::findOrFail($data['theme_id']);
        $resume = Resume::findOrFail($data['resume_id']);

        if (auth()->user()->id !== $resume->user_id) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $this->render($resume, $theme);
    }

    private function render(Resume $resume, Theme $theme) {
        $response = Http::post("{$this->jsonResumeAPi}/theme/{$theme->theme}", [
            'resume' => $resume->content,
        ]);

        return response($response, $response->status());
    }

    public function create() {
        $resumes = auth()->user()->resumes;
        $themes = Theme::all();
        $update = false;

        return view('publishes/edit', compact('resumes', 'themes', 'update'));
    }

    public function store(Request $request) {
        $data = $request->validate($this->rules);
        $publish = auth()->user()->publishes()->create($data);
        $url = route('publishes.show', $publish->id);
        $publish->update(compact('url'));
        $resume = $publish->resume()->get()->first();
        $theme = $publish->theme()->get()->first();

        Mail::to($request->user())->send(new ResumePublished($resume));

        return redirect(route('publishes.index'))->with('alert', [
            'type' => 'success',
            'messages' => ["Resume {$resume->title} published with theme {$theme->theme} at <a href='{$url}'>{$url}</a>"]
        ]);
    }

    public function edit(Publish $publish) {
        $this->authorize('update', $publish);
        $resumes = auth()->user()->resumes;
        $themes = Theme::all();
        $update = true;

        return view('publishes/edit', compact('publish', 'resumes', 'themes', 'update'));
    }

    public function update(Request $request, Publish $publish) {
        $data = $request->validate($this->rules);
        $this->authorize('update', $publish);
        $publish->update($data);

        return redirect(route('publishes.index'))->with('alert', [
            'type' => 'success',
            'messages' => ["Publish {$publish->url} updated"]
        ]);
    }

    public function destroy(Publish $publish) {
        $this->authorize('delete', $publish);
        $publish->delete();


        return redirect(route('publishes.index'))->with('alert', [
            'type' => 'danger',
            'messages' => ["Publish {$publish->url} deleted"]
        ]);
    }
}
