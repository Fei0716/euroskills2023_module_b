@auth
<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid ">
        <a class="navbar-brand text-white" href="{{route('workspace.index')}}">API Billing Management Portal</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
{{--        <div class="collapse navbar-collapse" id="navbarNav">--}}
{{--            <ul class="navbar-nav mx-auto">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active text-white" aria-current="page" href="{{route('workspace.index')}}">Workspace</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link text-white" href="#">Billing Quotas</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link text-white" href="#">Bills</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

        <form action="{{route('user.logout')}}" method="post" id="form-logout" hidden>
            @csrf
        </form>

        <button class="btn btn-light" onclick="document.getElementById('form-logout').submit()">Logout</button>
    </div>
</nav>
@endauth
