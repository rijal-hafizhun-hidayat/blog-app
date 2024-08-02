<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="#">Blog-App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="#">Home</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a @class([
                            'nav-link text-white',
                            'active fw-bold' => request()->routeIs('user.*'),
                        ]) href="{{ route('user.index') }}">User</a>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link text-white',
                            'active fw-bold' => request()->routeIs('post.*'),
                        ]) href="{{ route('post.index') }}">Post</a>
                    </li>
                    <li class="nav-item">
                        <a @class([
                            'nav-link text-white',
                            'active fw-bold' => request()->routeIs('role.*'),
                        ]) href="{{ route('role.index') }}">Role</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('auth.logout') }}">Log out
                            ({{ Auth::user()->name }})</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
