@extends('layout.main')

@section('content')
    <section aria-label="Workspace Details Section">
        <h1 class="text-center mb-4">Workspace: {{$workspace->title}}</h1>

        <div class="d-flex justify-content-between mb-2">
            <h2>API Tokens</h2>
            <a href="{{route('token.create', $workspace)}}" class="btn btn-dark">Create Token</a>
        </div>
        <table class="table table-responsive-md">
            <tr>
                <th class="bg-dark text-white">#</th>
                <th class="bg-dark text-white">Name</th>
                <th class="bg-dark text-white">Revoke Date</th>
                <th class="bg-dark text-white"></th>
            </tr>

            @foreach($workspace->tokens as $key=>$t)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$t->name}}</td>
                    <td>{{$t->deleted_at ? date('d-m-Y',strtotime($t->deleted_at) ) : 'Still Active'}}</td>
                    <td>
                        <form action="{{route('token.destroy', [$workspace, $t])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-dark {{$t->deleted_at ? 'disabled' : ''}}" type="submit">Revoke</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>


        <article aria-label="Billing Quota Section" class="mt-5">
            @php
                $total =  0;
                $currentMonth = \Carbon\Carbon::now()->format('m');
                foreach($workspace->tokens as $t){
                    $total += collect($t->services())->sum(function($s) use ($currentMonth){
                        return $s[$currentMonth]? $s[$currentMonth]->total_cost : 0;
                    });
                }
                $total = number_format($total, 2);
            @endphp
            @if($workspace->billing_quota_limit)
                <div class="mb-2">
                    <h2>Billing Quota: ${{number_format($workspace->billing_quota_limit , 2)}} - <em>Current Total Used: ${{$total}}</em></h2>
                    <div class="mb-2">{{$workspace->remaining_days}} days until the next billing</div>
                    <a  href="{{route('workspace.checkBill' , $workspace)}}" class="d-block mb-4 text-dark">Generate Bill</a>
                    <form action="{{route('workspace.destroy', $workspace)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-dark">Remove Limit</button>
                    </form>
                </div>
            @else
                <div class="mb-2">
                    <h2 class="mb-2">Billing Quota: Unlimited - <em>Current Total Used: ${{$total}}</em></h2>
                    <a  href="{{route('workspace.checkBill' , $workspace)}}" class="d-block mb-4 text-dark">Generate Bill</a>
                    <form action="{{route('workspace.updateQuota', $workspace)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-2 col-4">
                            <label for="limit">Quota Limit($)</label>
                            <input type="number" name="limit" id="limit" min="0" step=".01" class="form-control" required>
                        </div>
                        <button class="btn btn-dark" type="submit">Set</button>
                    </form>
                </div>
            @endif
        </article>
    </section>
@endsection
