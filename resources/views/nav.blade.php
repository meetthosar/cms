<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{!! url('/home') !!}">My Account</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('login') !!}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{!! route('register') !!}">Register</a>
                </li>
            @endauth
        </ul>
        <form class="form-inline my-2 my-lg-0" action="/" method="post">
            @csrf
            <input class="form-control mr-sm-2" type="search" value="{!! isset($search)? $search : null !!}" name="search" placeholder="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="jumbotron text-center">
    <h1>My First CMS</h1>
    <p>Happy Reading!</p>
</div>
