@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Edit Resume</div>

        <div class="card-body">
          <form method="POST" action="{{ route('resumes.update', $resume->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="title" class="">Resume Title</label>
                <input
                  id="title"
                  type="text"
                  class="form-control w-100 @error('title') is-invalid @enderror"
                  name="title"
                  value="{{ old('title') ?? $resume->title }}"
                  required
                  autocomplete="title"
                  autofocus
                >
                @error('title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

            <div class="form-group">
              <label for="name" class="">Name</label>
                <input
                  id="name"
                  type="text"
                  class="form-control w-100 @error('name') is-invalid @enderror"
                  name="name"
                  value="{{ old('name') ?? $resume->user->name }}"
                  required
                  autocomplete="name"
                  autofocus
                >
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

           <div class="form-group">
              <label for="email" class="">Email</label>
                <input
                  id="email"
                  type="text"
                  class="form-control w-100 @error('email') is-invalid @enderror"
                  name="email"
                  value="{{ old('email') ?? $resume->email }}"
                  required
                  autocomplete="email"
                  autofocus
                >
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

            <div class="form-group">
              <label for="website" class="">Website</label>
                <input
                  id="website"
                  type="text"
                  class="form-control w-100 @error('website') is-invalid @enderror"
                  name="website"
                  value="{{ old('website') ?? $resume->website }}"
                  autocomplete="website"
                  autofocus
                >
                @error('website')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

           <div class="form-group">
              <label for="picture" class="">Profile Picture</label>
                <input
                  id="picture"
                  type="file"
                  class="form-control-file @error('picture') is-invalid @enderror"
                  name="picture"
                >
                @error('picture')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

            <div class="form-group">
              <lable for="about">About</lable>
              <textarea name="about" class="w-100">{{ old('about') ?? $resume->about }}</textarea>
            </div>

            <button class="btn btn-primary" id="submit">
              Submit
            </button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
