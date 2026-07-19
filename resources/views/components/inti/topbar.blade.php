<div class="topbar">

<div>

<h4 class="fw-bold">

@yield('header')

</h4>

</div>

<div class="top-right">

<form
method="POST"
action="{{ route('logout') }}">

@csrf

<button class="btn btn-danger">

Logout

</button>

</form>

</div>

</div>