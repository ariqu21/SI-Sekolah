<nav class="navbar navbar-expand-lg navbar-custom fixed-top">

<div class="container">

<a
href="/"
class="navbar-brand logo">

<img

src="{{ asset(
'assets/logo.png'
) }}"

width="52"

class="logo-img">

<span>

Sistem Informasi Sekolah

</span>

</a>

<button
    class="navbar-toggler"
    type="button"
    data-bs-toggle="collapse"
    data-bs-target="#nav">

    <span class="navbar-toggler-icon"></span>

</button>

<div

class="collapse navbar-collapse"

id="nav">

<ul class="navbar-nav ms-auto align-items-lg-center">

<!-- <li class="nav-item">

<a

href="/"

class="nav-link

{{ request()->is('/')
? 'active'
: '' }}

">

Beranda

</a>

</li>


<li class="nav-item">

<a

href="{{ route('profil') }}"

class="nav-link

{{ request()->is('profil')
? 'active'
: '' }}

">

Profil

</a>

</li>


<li class="nav-item">

<a

href="{{ route('posts') }}"

class="nav-link

{{ request()->is('posts*')
? 'active'
: '' }}

">

Kegiatan

</a>

</li> -->


<!-- <li class="nav-item">

<a

href="{{ route('registrasi') }}"

class="nav-link

{{ request()->is('pendaftaran')
? 'active'
: '' }}

">

Pendaftaran

</a>

</li>

<li class="nav-item">
    <a
        href="{{ route('payment.check') }}"
        class="nav-link
        {{ request()->is('cek-pembayaran')
        ? 'active'
        : '' }}

        ">
        Cek Pembayaran
    </a>
</li> -->

@guest

<li class="nav-item">

<a

href="/"

class="nav-link

{{ request()->is('/')
? 'active'
: '' }}

">

Beranda

</a>

</li>


<li class="nav-item">

<a

href="{{ route('profil') }}"

class="nav-link

{{ request()->is('profil')
? 'active'
: '' }}

">

Profil

</a>

</li>


<li class="nav-item">

<a

href="{{ route('posts') }}"

class="nav-link

{{ request()->is('posts*')
? 'active'
: '' }}

">

Kegiatan

</a>

</li>

<li class="nav-item">

    <a
        href="{{ route('wali.register') }}"
        class="nav-link
        {{ request()->is('wali/register')
        ? 'active'
        : '' }}">

        Register

    </a>

</li>

<li class="nav-item">

    <a
        href="{{ route('wali.login') }}"
        class="nav-link
        {{ request()->is('wali/login')
        ? 'active'
        : '' }}">

        Login

    </a>

</li>

@endguest


@auth

@if(auth()->user()->role == 'wali')

<li class="nav-item">

    <a
        href="{{ route('wali.home') }}"
        class="nav-link
        {{ request()->is('wali/home')
        ? 'active'
        : '' }}">

        Portal Wali

    </a>

</li>

<li class="nav-item">

<a

href="{{ route('registrasi') }}"

class="nav-link

{{ request()->is('pendaftaran')
? 'active'
: '' }}

">

Pendaftaran

</a>

</li>

<li class="nav-item">
    <a
        href="{{ route('wali.payment') }}"
        class="nav-link
        {{ request()->is('wali/payment')
        ? 'active'
        : '' }}

        ">
        Cek Pembayaran
    </a>
</li>

<li class="nav-item">

<a
href="{{ route('wali.payment.proof') }}"
class="nav-link 
{{ request()->is('wali/payment/proof')
        ? 'active'
        : '' }}
        ">
Upload Bukti

</a>

</li>

<li class="nav-item">

    <form
        action="{{ route('wali.logout') }}"
        method="POST"
        class="d-inline">

        @csrf

        <button
            type="submit"
            class="btn btn-link nav-link p-0">

            Logout

        </button>

    </form>

</li>

@endif

@endauth


</ul>

</div>

</div>

</nav>