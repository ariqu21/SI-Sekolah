@extends('frontend.layout')

@section('styles')

<link
href="{{ asset('css/landing.css') }}"
rel="stylesheet">

<style>

:root{

--green:#2E7D32;

}


/* HERO */

.news-header{

padding:

180px 0 120px;

position:relative;

background:

linear-gradient(

rgba(0,0,0,.45),

rgba(0,0,0,.45)

),

url('{{ asset("assets/hero2.jpeg") }}');

background-size:cover;

background-position:center;

color:white;

text-align:center;

}


.news-header h1{

font-size:64px;

font-weight:800;

margin-bottom:20px;

}


.news-header p{

font-size:20px;

opacity:.95;

}


.news-hero-box{

display:inline-block;

padding:

45px 60px;

border-radius:

30px;

background:

rgba(
255,
255,
255,
0.08
);

backdrop-filter:

blur(12px);

}


/* SEARCH */

.news-search{

max-width:700px;

margin:auto;

margin-top:35px;

}


.news-search input{

height:65px;

border:none;

border-radius:50px;

padding:

0 30px;

background:

rgba(
255,
255,
255,
0.15
);

color:white;

backdrop-filter:

blur(10px);

}


.news-search input::placeholder{

color:

rgba(
255,
255,
255,
0.75
);

}


.news-search input:focus{

outline:none;

box-shadow:

0 0 0 5px rgba(
255,
255,
255,
0.15
);

}


/* SECTION */

.news-section{

padding:

100px 0;

background:

#F7FAF7;

}


/* CARD */

.news-card{

background:white;

border-radius:28px;

overflow:hidden;

height:100%;

box-shadow:

0 12px 35px rgba(
0,
0,
0,
0.06
);

transition:.35s;

border:none;

}


.news-card:hover{

transform:

translateY(-8px);

box-shadow:

0 25px 55px rgba(
0,
0,
0,
0.12
);

}


.news-image{

height:260px;

width:100%;

object-fit:cover;

transition:.4s;

}


.news-card:hover .news-image{

transform:

scale(1.05);

}


.news-content{

padding:

32px;

}


.news-date{

display:inline-block;

padding:

8px 16px;

background:

#E8F5E9;

color:

var(--green);

font-weight:600;

border-radius:

50px;

margin-bottom:18px;

font-size:13px;

}


.news-content h4{

font-weight:700;

margin-bottom:18px;

font-size:24px;

}


.news-content p{

color:#666;

line-height:1.8;

}


/* BUTTON */

.news-btn{

display:inline-flex;

align-items:center;

gap:10px;

padding:

13px 24px;

border-radius:

14px;

background:

linear-gradient(

135deg,

#2E7D32,

#4CAF50

);

border:none;

color:white;

font-weight:600;

text-decoration:none;

transition:.3s;

}


.news-btn:hover{

transform:

translateY(-3px);

color:white;

}


/* PAGINATION */

.pagination{

justify-content:center;

gap:10px;

}


.page-link{

border:none;

border-radius:12px;

padding:

12px 18px;

color:

var(--green);

}


.page-item.active .page-link{

background:

var(--green);

}


/* EMPTY */

.empty-box{

padding:

100px 30px;

background:white;

border-radius:

30px;

box-shadow:

0 10px 35px rgba(
0,
0,
0,
0.05
);

}

</style>

@endsection


@section('content')


<!-- HERO -->

<section class="news-header">

<div class="container">

<div class="news-hero-box">

<h1>

Info & Kegiatan Sekolah

</h1>

<p>

Informasi terbaru mengenai kegiatan,
pengumuman,
dan prestasi sekolah

</p>


<div class="news-search">

<input

placeholder="Cari berita...">

</div>

</div>

</div>

</section>



<!-- POSTS -->

<section class="news-section">

<div class="container">

<div class="row g-4">


@forelse($posts as $post)

<div class="col-lg-4 col-md-6">

<div class="news-card">


@if($post->thumbnail)

<img

src="{{ asset(
'storage/'.$post->thumbnail
) }}"

class="news-image">

@else

<img

src="https://picsum.photos/600/400?random={{ $post->id }}"

class="news-image">

@endif



<div class="news-content">


<div class="news-date">

{{

$post
->created_at
->format('d M Y')

}}

</div>


<h4>

{{ $post->title }}

</h4>


<p>

{{

Str::limit(

strip_tags(
$post->content
),

120

)

}}

</p>



<a

href="{{ route(
'posts.show',
$post->slug
) }}"

class="news-btn">

Baca Selengkapnya →

</a>


</div>

</div>

</div>

@empty


<div class="col-12">

<div class="empty-box text-center">

<h3>

Belum ada berita

</h3>

<p>

News dan kegiatan sekolah akan muncul di sini

</p>

</div>

</div>

@endforelse


</div>


<div class="mt-5">

{{ $posts->links() }}

</div>


</div>

</section>


@endsection