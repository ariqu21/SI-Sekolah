@extends('layouts.admin')

@section('content')

<div class="table-card">

<form

method="POST"

action="{{route('admin.posts.store')}}"

enctype="multipart/form-data">

@csrf


<input

name="title"

class="form-control mb-3"

placeholder="Judul">


<input

type="file"

name="thumbnail"

class="form-control mb-3">


<select

name="status"

class="form-control mb-3">

<option>

Draft

</option>

<option>

Published

</option>

</select>


<textarea

name="content"

rows="8"

class="form-control mb-3">

</textarea>


<button class="btn btn-primary">

Publish

</button>

</form>

</div>

@endsection