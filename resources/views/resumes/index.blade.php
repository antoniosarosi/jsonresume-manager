@extends('layouts.app')

@section('content')
    <div class="container">
      @if(session('alert'))
        <div class="alert alert-{{ session('alert')['type'] }} alert-dismissible fade show" role="alert">
          {{ session('alert')['message'] }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($resumes as $resume)
            <tr>
              <th scope="row" class="font-weight-normal">
                <a href="{{ route('resumes.show', $resume->id) }}">{{ $resume->title }}</a>
              </th>
              <td>
                <div class="d-flex justify-content-end">
                  <div class="">
                    <a href="{{ route('resumes.edit', $resume->id) }}">
                      <button class="btn btn-primary">
                        Edit
                      </button>
                    </a>
                  </div>
                  <div class="ml-2">
                    <form
                      method="POST"
                      action="{{ route('resumes.destroy', $resume->id) }}"
                    >
                      @csrf
                      @method('DELETE')
                      <button type="submit"class="btn btn-danger">
                        Delete
                      </button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div>
        <div class="col-sm-6 col-md-3 mx-0 px-0">
          <a href="{{ route('resumes.create') }}">
            <button class="btn btn-block btn-primary">
              Create New Resume
            </button>
          </a>
        </div>
      </div>
    </div>
@endsection
