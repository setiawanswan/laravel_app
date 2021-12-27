@extends('layouts.app')

@section('title', $post['title'])

@section('content')

@if($post['is_new'])
<div>A new blog post ! Using If</div>
@elseif(!$post['is_new'])
<div>Blog post is old !, Using else if</div>
@endif

@unless($post['is_new'])
<div>It is an old post ... using unless</div>
@endunless

<h1> {{ $post['title'] }} </h1>
<p> {{ $post['content'] }} </p>

@isset($post['has_comments'])
<div>The post has some comment ... using isset</div>
@endisset

@endsection