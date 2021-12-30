@extends('layouts.app')

@section('title', 'Blog post !')

@section('content')
    @forelse($posts as $key => $post)
        @include('posts.partials.post')
    @empty
    No found Post !
    @endforelse
@endsection