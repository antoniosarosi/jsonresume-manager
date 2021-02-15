<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumes = auth()->user()->resumes;

        return view('resumes.index', compact('resumes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resumes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $resume = $user->resumes()->where('title', $request['title'])->first();
        if ($resume) {
            return back()
                ->withInput(['title' => $request['title']])
                ->withErrors(['title' => 'You already have a resume with this title!']);
        }

        $resume = $user->resumes()->create([
            'title' => $request['title'],
            'name' => $user->name,
            'email' => $user->email,
        ]);

        return redirect()->route('resumes.index')->with('alert', [
            'type' => 'success',
            'message' => "Resume $resume->title created"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        return view('resumes.show', compact('resume'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        return view('resumes.edit', compact('resume'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {        
        if ($resume->user->id != auth()->user()->id) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'email',
            'website' => 'nullable|url',
            'picture' => 'nullable|image',
            'about' => 'nullable|string',
            'title' => Rule::unique('resumes')->where(function ($query) use ($resume) {
                return $query->where('user_id', $resume->user->id);
            })->ignore($resume->id)
        ]);

        if ($data['picture']) {
            $picture = $data['picture']->store('pictures', 'public');
            Image::make(public_path("storage/$picture"))->fit(800, 800)->save();
            $data['picture'] = "/storage/$picture";
        }

        $resume->update($data);
    
        return redirect()->route('resumes.index')->with('alert', [
            'type' => 'primary',
            'message' => "Resume $resume->title updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        if ($resume->user->id != auth()->user()->id) {
            abort(403);
        }

        $resume->delete();
    
        return redirect()->route('resumes.index')->with('alert', [
            'type' => 'danger',
            'message' => "Resume $resume->title deleted",
        ]);
    }
}
