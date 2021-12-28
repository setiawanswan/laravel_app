@extends('layouts.app')

@section('title', 'Blog post !')

@section('content')
    @forelse($posts as $key => $post)
    @if($loop->even)
        <div> {{$key}}.{{ $post['title'] }} </div>
    @else
        <div style="background-color:silver"> {{$key}}.{{ $post['title'] }} </div>
    @endif
    @empty
    No found Post !
    @endforelse
@endsection