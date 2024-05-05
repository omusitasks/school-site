<!-- Navbar start -->
<!-- <div class="container-fluid position-relative p-0"> -->
<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
    <a href="{{ route('welcome.index') }}" class="navbar-brand p-0">
        <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>The Buffalo Academy</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('welcome.index') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ route('public.about.index') }}" class="nav-item nav-link">About</a>
            <a href="{{ route('public.services.index') }}" class="nav-item nav-link">Services</a>
            <a href="{{ route('public.ai.index') }}" class="nav-item nav-link">AI</a>
            <a href="{{ route('public.blogs.index') }}" class="nav-item nav-link">Blogs</a>
            <a href="{{ route('public.contact.index') }}" class="nav-item nav-link">Contact</a>
            
            <!-- Authentication -->
            <div class="nav-item dropdown">
            @if (Route::has('login'))
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Accounts</a>
                <div class="dropdown-menu m-0">
                @auth
                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                <!-- <a href="{{ url('/logout') }}" class="dropdown-item">Logout</a> -->

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="dropdown-item">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                @else
                    <a href="{{ route('login') }}" class="dropdown-item">Login</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="dropdown-item">Register</a>
                    @endif
                @endauth
                </div>
            @endif
            </div>
        </div>
        <!-- <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i
                class="fa fa-search"></i></butaton> -->
        <a href="{{ route('public.courses.index') }}" class="btn btn-primary py-2 px-4 ms-3">Enroll Courses</a>
    </div>
</nav>
<!-- </div> -->

<!-- Navbar end -->

