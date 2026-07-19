<div class="sidebar">

<div class="logo">

SI-RA Al-Jihad

</div>

<ul>

<li class="menu-title">

Main Home

</li>


<li>

<a
href="{{ url('/admin/dashboard') }}"

class="{{ request()->routeIs('admin.dashboard')
? 'active' : '' }}">

<i class="bi bi-grid"></i>

Dashboard

</a>

</li>


<li>

<a
href="{{ route('admin.registrasi.index') }}"

class="{{ request()->routeIs('admin.registrasi.*')
? 'active' : '' }}">

<i class="bi bi-people"></i>

Data Pendaftaran

</a>

</li>

<li>

<a
href="{{route('admin.posts.index')}}"

class="{{ request()
->routeIs('admin.posts.*')
?'active':'' }}">

<i class="bi bi-newspaper"></i>

Info / Post

</a>

</li>

<li>

<a
href="{{ route('admin.profil.index') }}"

class="{{ request()
->routeIs('admin.profil.*')

?'active':'' }}">

<i class="bi bi-building"></i>

Profil Sekolah

</a>

</li>

<li>

<a

href="{{ route(
'admin.guru.index'
)}}"

class="{{ request()
->routeIs('admin.guru.*')

?'active':'' }}">

<i class="bi bi-people"></i>

Data Guru

</a>

</li>

<li>

<a href="{{ route('admin.payment-types.index') }}" class="{{ request()->routeIs('admin.payment-types.*') ? 'active' : '' }}">

<i class="bi bi-cash-stack"></i>

Jenis Pembayaran

</a>

</li>

<li>
    <a href="{{ route('payments.index') }}" class="{{ request()->routeIs('payments.*') ? 'active' : '' }}">
        <i class="bi bi-wallet2"></i>
        Pembayaran
    </a>
</li>

</ul>

</div>