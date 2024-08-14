@extends('layout.main')

@section('content')

    <section aria-label="Update Workspace Section">
        <div class="card shadow-sm px-2 py-4 w-50 mx-auto">
            <div class="card-body">
                <h1 class="mb-4">Update Workspace</h1>
                <form action="{{route('workspace.update' , $workspace)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-1">
                        <label for="title">Title: </label>
                        <input type="text" name="title" id="title" value="{{$workspace->title}}" class="form-control @error('title') is-invalid @enderror" required>
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description">Description(optional): </label>
                        <textarea id="description" name="description"  class="form-control">{{$workspace->description}}</textarea>
                    </div>

                    <div class="display-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-dark">Update</button>
                        <button type="reset" class="btn btn-outline-dark">Reset</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
