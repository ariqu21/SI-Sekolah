@extends('layouts.admin')

@section('content')

<div class="table-card">

<h4 class="mb-4">

Edit Post

</h4>

<form

method="POST"

action="{{ route(
'admin.admin.posts.update',
$post->id
) }}"

enctype="multipart/form-data">

@csrf

@method('PUT')


<input

name="title"

value="{{ $post->title }}"

class="form-control mb-3">


@if($post->thumbnail)

<img

src="{{ asset(
'storage/'.
$post->thumbnail
) }}"

width="180"

class="mb-3">

@endif


<input

type="file"

name="thumbnail"

class="form-control mb-3">


<select

name="status"

class="form-control mb-3">

<option
value="Draft"

{{ $post->status=="Draft"
?'selected':'' }}>

Draft

</option>

<option
value="Published"

{{ $post->status=="Published"
?'selected':'' }}>

Published

</option>

</select>


<textarea

name="content"

rows="10"

class="form-control mb-3">{{

$post->content

}}</textarea>


<button class="btn btn-primary">

Update

</button>

</form>

</div>

@endsection