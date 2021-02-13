@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      @foreach($publishes as $publish)
        <div class="col-md-4 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <h3 class="card-title text-capitalize">
                {{ $publish->resume()->get()->first()->title }}
              </h3>
              <a href="{{ $publish->url }}">{{ $publish->url }}</a>
              <p>{{ $publish->created_at }}</p>
              <div class="d-lg-inline-flex">
                <div>
                  <a href="{{ route('publishes.edit', $publish->id) }}" class="btn btn-primary mb-2">
                    <i class="fas fa-pencil-alt"></i>
                    Edit Publish
                  </a>
                </div>
                <div class="ml-lg-1">
                  <form method="POST" action="{{ route('publishes.destroy', $publish->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                      <i class="fa fa-trash"></i>
                      Delete Publish
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
