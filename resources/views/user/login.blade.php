@extends('layout.main')

@section('content')

    <section aria-label="Login Form Section">
        <div class="card shadow-sm px-2 py-4 w-50 mx-auto">
            <div class="card-body">
                <h1 class="mb-4">Login</h1>
                <form action="{{route('user.login')}}" method="post">
                    @csrf
                    <div class="mb-1">
                        <label for="username">Username: </label>
                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" required>
                        @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password">Password: </label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="display-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-dark">Submit</button>
                        <button type="reset" class="btn btn-outline-dark">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
