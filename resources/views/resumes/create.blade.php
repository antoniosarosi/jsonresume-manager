@extends('layouts.app')
@section('content')
  <div class="container">
    <resume-form :resume="{{ $resume }}" />
{{--     <resume-form />--}}
  </div>
@endsection
