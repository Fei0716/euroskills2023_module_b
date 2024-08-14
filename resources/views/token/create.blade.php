@extends('layout.main')

@section('content')

    <section aria-label="Create Workspace Section">
        @if(Session::has('success'))
            <div class="alert alert-success text-center mb-2">
                <div>{{Session::get('success')}} <br> <strong>Please take note that the token is visible this one time only</strong></div>
            </div>
        @endif
        <div class="card shadow-sm px-2 py-4 w-50 mx-auto">
            <div class="card-body">
                <h1 class="mb-4">Create New Token</h1>
                <form action="{{route('token.store', $workspace)}}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="name">Name: </label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')
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
