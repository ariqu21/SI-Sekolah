@extends('frontend.layout')

@section('styles')

<link
href="{{ asset('css/landing.css') }}"
rel="stylesheet">

@endsection


@section('content')

@php
use Illuminate\Support\Str;
@endphp


<!-- HERO -->

<section class="hero">

<div id="heroCarousel"

class="carousel slide carousel-fade"

data-bs-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active">

<img
src="{{ asset('assets/hero1.jpg') }}"
class="hero-bg">

</div>

<div class="carousel-item">

<img
src="{{ asset('assets/hero2.jpeg') }}"
class="hero-bg">

</div>

<div class="carousel-item">

<img
src="{{ asset('assets/hero3.jpeg') }}"
class="hero-bg">

</div>

</div>

</div>


<div class="hero-overlay">

<div class="container">

<div class="hero-box">

<span class="section-tag">

SELAMAT DATANG

</span>


<h2>

Sistem Informasi 

<span>

Sekolah

</span>

-

</h2>

<p>

Mewujudkan pendidikan berkualitas,
karakter unggul,
dan masa depan cerah.

</p>


<a

href="{{ route('registrasi') }}"

class="green-btn">

Daftar Sekarang

</a>

</div>

</div>

</div>

</section>



<!-- ABOUT -->

<section class="section-space">

<div class="container">

<div class="row align-items-center g-5">

<div class="col-lg-6">

<img

src="{{ asset('assets/sekolah.jpeg') }}"

class="about-img">

</div>


<div class="col-lg-6">

<span class="section-tag">

Tentang Sekolah

</span>

<h2>

Profil Singkat Sekolah

</h2>


<p>

{{

Str::limit(

$profil->sejarah ??

'Profil belum tersedia',

250

)

}}

</p>


<a

href="{{ route('profil') }}"

class="green-btn">

Lihat Profil

</a>

</div>

</div>

</div>

</section>



<!-- GALLERY -->

<section class="gallery-section">

<div class="container">

<div class="section-header">

<span>

GALERI SEKOLAH

</span>

<h2>

Foto Kegiatan & Fasilitas

</h2>

</div>


<div class="gallery-grid">

@foreach($gallery as $img)

<div class="gallery-item">

<img

src="{{ asset(
'storage/'.$img->thumbnail
) }}"

class="gallery-img">

</div>

@endforeach

</div>

</div>

</section>



<!-- NEWS -->

<section class="section-space">

<div class="container">


<div class="section-header d-flex justify-content-between">

<div>

<span>

BERITA TERBARU

</span>

<h2>

News & Kegiatan

</h2>

</div>


<a

href="{{ route('posts') }}"

class="green-btn">

Lihat Semua

</a>

</div>


<div class="row g-4 mt-4">

@if($posts->count())

@foreach($posts as $post)

<div class="col-lg-6">

<div class="news-card">

@if($post->thumbnail)

<img

src="{{ asset(
'storage/'.$post->thumbnail
) }}">

@endif


<div class="news-body">

<small>

{{

$post->created_at
->format(
'd M Y'
)

}}

</small>


<h4>

{{$post->title}}

</h4>


<p>

{{

Str::limit(

strip_tags(
$post->content
),

100

)

}}

</p>


<a

href="{{ route(
'posts.show',
$post->slug
) }}"

class="green-btn">

Baca

</a>

</div>

</div>

</div>

@endforeach

@endif

</div>

</div>

</section>

<!-- FOOTER -->

<footer class="footer">

<div class="container text-center">

Copyright ©

{{ date('Y') }}

RA Al-Jihad Pontianak

</div>

</footer>


@endsection