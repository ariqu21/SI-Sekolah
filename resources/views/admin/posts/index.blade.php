@extends('layouts.admin')

@section('content')

<div class="table-card">

<div class="d-flex justify-content-between mb-4">

<h4>

News / Kegiatan

</h4>

<a href="{{route('admin.posts.create')}}"
    class="btn btn-primary">

Tambah

</a>

</div>


<table class="table">

<thead>

<tr>

<th>Thumbnail</th>

<th>Judul</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

@foreach($posts as $item)

<tr>

<td>

@if($item->thumbnail)

<img src="{{asset('storage/'.$item->thumbnail)}}"
    width="70">

@endif

</td>

<td>

{{$item->title}}

</td>

<td>

{{$item->status}}

</td>

<td>

<a

href="{{route(
'admin.posts.edit',
$item->id
)}}"

class="btn btn-warning btn-sm">

Edit

</a>


<form

method="POST"

action="{{route(
'admin.posts.destroy',
$item->id
)}}"

class="d-inline">

@csrf

@method('DELETE')

<button
class="btn btn-danger btn-sm">

Delete

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection