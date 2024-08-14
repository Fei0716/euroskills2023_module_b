@extends('layout.main')

@section('content')

    <section aria-label="Create Workspace Section">
        <div class="card shadow-sm px-2 py-4 w-50 mx-auto">
            <div class="card-body">
                <h1 class="mb-4">Create New Workspace</h1>
                <form action="{{route('workspace.store')}}" method="post">
                    @csrf
                    <div class="mb-1">
                        <label for="title">Title: </label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description">Description(optional): </label>
                        <textarea id="description" name="description" class="form-control"></textarea>
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
