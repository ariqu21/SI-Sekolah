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

.post-hero{

padding:

180px 0 120px;

background:

linear-gradient(

rgba(0,0,0,.45),

rgba(0,0,0,.45)

),

url('{{ $post->thumbnail ? asset("storage/".$post->thumbnail) : asset("assets/hero2.jpeg") }}');

background-size:cover;

background-position:center;

text-align:center;

color:white;

position:relative;

}


.post-box{

max-width:900px;

margin:auto;

padding:

50px;

background:

rgba(
255,
255,
255,
0.08
);

backdrop-filter:

blur(12px);

border-radius:

30px;

}


.post-hero h1{

font-size:58px;

font-weight:800;

margin-bottom:20px;

}


.post-meta{

display:flex;

justify-content:center;

gap:20px;

flex-wrap:wrap;

opacity:.95;

}


/* ARTICLE */

.article-section{

padding:

100px 0;

background:

#F7FAF7;

}


.article-card{

background:white;

padding:

60px;

border-radius:

30px;

box-shadow:

0 15px 45px rgba(
0,
0,
0,
0.06
);

}


/* FEATURE IMAGE */

.feature-image{

width:100%;

max-height:600px;

object-fit:cover;

border-radius:

24px;

margin-bottom:40px;

}


/* TYPOGRAPHY */

.article-content{

font-size:18px;

line-height:2;

color:#444;

}


.article-content h1,

.article-content h2,

.article-content h3{

margin:

40px 0 20px;

font-weight:700;

}


.article-content img{

max-width:100%;

border-radius:

20px;

margin:

30px 0;

}


/* GALLERY */

.gallery-title{

margin:

60px 0 30px;

font-weight:700;

}


.gallery-grid{

display:grid;

grid-template-columns:

repeat(
3,
1fr
);

gap:20px;

}


.gallery-grid img{

width:100%;

height:220px;

object-fit:cover;

border-radius:

18px;

transition:.3s;

}


.gallery-grid img:hover{

transform:

scale(1.04);

}


/* BACK */

.back-btn{

display:inline-flex;

align-items:center;

gap:10px;

padding:

14px 28px;

background:

#2E7D32;

color:white;

text-decoration:none;

border-radius:

14px;

margin-top:60px;

}


.back-btn:hover{

color:white;

}

</style>

@endsection



@section('content')


<!-- HERO -->

<section class="post-hero">

<div class="container">

<div class="post-box">

<h1>

{{ $post->title }}

</h1>


<div class="post-meta">

<span>

📅

{{

$post
->created_at
->format('d M Y')

}}

</span>

</div>

</div>

</div>

</section>




<!-- ARTICLE -->

<section class="article-section">

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-10">

<div class="article-card">


@if($post->thumbnail)

<img

src="{{ asset(
'storage/'.$post->thumbnail
) }}"

class="feature-image">

@endif



<div class="article-content">

{!! $post->content !!}

</div>



<a

href="{{ route('posts') }}"

class="back-btn">

← Kembali ke News

</a>


</div>

</div>

</div>

</div>

</section>


@endsection