@extends('layout.main')

@section('content')
    <section aria-label="Workspaces List Section">
        <h1 class="text-center mb-4">Your Workspaces</h1>
        <div class="d-flex justify-content-end">
            <a href="{{route('workspace.create')}}" class="btn btn-dark mb-2">Create Workspace</a>
        </div>
        <table class="table table-responsive-md">
            <tr>
                <th class="bg-dark text-white">#</th>
                <th class="bg-dark text-white">Title</th>
                <th class="bg-dark text-white">Description</th>
                <th class="bg-dark text-white"></th>
            </tr>

            @foreach($workspaces as $key=> $w)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td><a href="{{route('workspace.show' , $w)}}" class="text-dark">{{$w->title}}</a></td>
                    <td>{{$w->description}}</td>
                    <td>
                        <a href="{{route('workspace.edit' , $w)}}"> <button class="btn btn-dark">Update</button></a>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
