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

.profile-hero{

position:relative;

padding:

180px 0 130px;

background:

linear-gradient(

rgba(0,0,0,.45),

rgba(0,0,0,.45)

),

url('{{ asset("assets/hero1.jpeg") }}');

background-size:cover;

background-position:center;

color:white;

text-align:center;

overflow:hidden;

}


.profile-hero h1{

font-size:64px;

font-weight:700;

margin-bottom:20px;

}


.profile-hero p{

font-size:20px;

opacity:.95;

}


.hero-box{

display:inline-block;

padding:

40px 60px;

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


/* SECTION */

.profile-section{

padding:

110px 0;

}


.section-title{

font-size:42px;

font-weight:700;

margin-bottom:40px;

text-align:center;

}


/* CARD */

.profile-card{

background:white;

padding:45px;

border-radius:30px;

box-shadow:

0 15px 40px rgba(
0,
0,
0,
.07
);

transition:.3s;

height:100%;

}


.profile-card:hover{

transform:

translateY(-6px);

}


/* PROGRAM */

.program-box{

background:

linear-gradient(

135deg,

#2E7D32,

#4CAF50

);

color:white;

}


/* VISION */

.vision-card{

border-top:

6px solid var(--green);

}


/* HISTORY */

.history-card{

position:relative;

padding-left:40px;

}


.history-card::before{

content:"";

position:absolute;

left:0;

top:0;

width:6px;

height:100%;

background:

var(--green);

border-radius:20px;

}


/* CONTACT */

.contact-item{

display:flex;

gap:15px;

margin-bottom:25px;

align-items:center;

padding:

18px;

background:

#F7F9F7;

border-radius:

15px;

}


.contact-icon{

width:50px;

height:50px;

background:

#E8F5E9;

display:flex;

align-items:center;

justify-content:center;

border-radius:50%;

color:

var(--green);

font-size:22px;

}

</style>

@endsection



@section('content')



<!-- HERO -->

<section class="profile-hero">

<div class="container">

<div class="hero-box">

<h1>

{{

$profil?->nama_sekolah

?? 'Profil Sekolah'

}}

</h1>

<p>

Membangun Generasi Masa Depan

</p>

</div>

</div>

</section>




<!-- PROGRAM -->

<section class="profile-section">

<div class="container">

<h2 class="section-title">

Program Sekolah

</h2>

<div class="profile-card program-box">

{!! nl2br(

$profil?->program

?? 'Belum tersedia'

) !!}

</div>

</div>

</section>




<!-- VISI MISI -->

<section class="profile-section bg-light">

<div class="container">

<h2 class="section-title">

Visi & Misi

</h2>


<div class="row g-4">

<div class="col-lg-6">

<div class="profile-card vision-card">

<h3>

Visi

</h3>

<hr>

<p>

{!! nl2br(
$profil?->visi ?? '-'
) !!}

</p>

</div>

</div>



<div class="col-lg-6">

<div class="profile-card vision-card">

<h3>

Misi

</h3>

<hr>

<p>

{!! nl2br(
$profil?->misi ?? '-'
) !!}

</p>

</div>

</div>

</div>

</div>

</section>




<!-- HISTORY -->

<section class="profile-section">

<div class="container">

<h2 class="section-title">

Sejarah Sekolah

</h2>


<div class="profile-card history-card" style="text-align: justify;">

{!! nl2br(

$profil?->sejarah

?? '-'

) !!}

</div>

</div>

</section>




<!-- CONTACT -->

<section class="profile-section bg-light">

<div class="container">

<h2 class="section-title">

Kontak Sekolah

</h2>


<div class="profile-card">

<section class="py-5 bg-light" id="lokasi">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Lokasi Sekolah
            </h2>

            <p class="text-muted">
                RA Al-Jihad Pontianak
            </p>

        </div>

        <div class="row g-4 align-items-center">

            <div class="col-lg-5">

                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <h4 class="mb-3">
                            RA Al-Jihad Pontianak
                        </h4>

                        <p>
                            JL. KOM. YOS SUDARSO GG.SUKAMAJU DALAM 3,
                            Pontianak Barat,
                            Kota Pontianak,
                            Kalimantan Barat
                        </p>

                        <a
                            href="https://maps.app.goo.gl/1ofdqDUwbiReQsJk9"
                            target="_blank"
                            class="btn btn-success">

                            Buka di Google Maps

                        </a>

                    </div>

                </div>

            </div>

            <div class="col-lg-7">

                <div class="ratio ratio-16x9 shadow rounded overflow-hidden">

                    <iframe
                        src="https://maps.google.com/maps?q=-0.0163134,109.3251354&z=17&output=embed"
                        style="border:0;"
                        allowfullscreen
                        loading="lazy">
                    </iframe>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- <div class="contact-item">

<div class="contact-icon">

📍

</div>

<div>

<b>Alamat</b>

<br>

{{

$profil?->alamat

?? '-'

}}

</div>

</div> -->

<br>

<div class="contact-item">

<div class="contact-icon">

📞

</div>

<div>

<b>Telepon</b>

<br>

{{

$profil?->telepon

?? '-'

}}

</div>

</div>



<div class="contact-item">

<div class="contact-icon">

✉️

</div>

<div>

<b>Email</b>

<br>

{{

$profil?->email

?? '-'

}}

</div>

</div>


</div>

</div>

</section>


@endsection