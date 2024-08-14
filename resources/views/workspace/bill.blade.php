@extends('layout.main')

@section('content')
    <section aria-label="Workspace Details Section">
        <h1 class="text-center mb-4">Workspace: {{$workspace->title}}'s Bill</h1>
        @php
            $months = [];
            foreach($workspace->tokens as  $token){
                foreach($token->service_usages as $su){
                    if(!in_array(\Illuminate\Support\Carbon::parse($su->created_at)->format('m'), $months, true)){
                        $months[] = \Illuminate\Support\Carbon::parse($su->created_at)->format('m');
                    }
                }
            }
        @endphp
        <form action="#" method="get" class="mb-2 col-2 ms-auto" id="form">
            <label for="month"></label>
            <select name="month" id="month" class="form-select" onchange="document.getElementById('form').submit()">
                <option selected disabled> Select Month</option>
                @foreach($months as $m)
                    <option value="{{$m}}"  {{isset($_GET['month']) && $_GET['month'] === $m ? 'selected' : '' }}>{{$m}}</option>
                @endforeach
            </select>
        </form>
        <table class="table table-responsive-md">
            <tr>
                <th class="bg-dark text-white" style="width: 60%">Token</th>
                <th class="bg-dark text-white">Time</th>
                <th class="bg-dark text-white">Per sec.</th>
                <th class="bg-dark text-white">Total</th>
            </tr>
            @php
                $month = isset($_GET['month']) ? $_GET['month']: \Carbon\Carbon::now()->format('m');
                $total =  0;
                foreach($workspace->tokens as $t){
                    $total += collect($t->services())->sum(function($s) use ($month){
                        return $s[$month]? $s[$month]->total_cost : 0;
                    });
                }
                $total = number_format($total, 2);
            @endphp
            @foreach($workspace->tokens->sortBy('name') as $key=>$t)
                @if(count($t->services()) > 0)
                    <tr>
                        <th>{{$t->name}} token</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($t->services() as $key=> $s)
                        <tr>
                            <td>{{$key}}</td>
                            <td>{{$s[$month]->total_time}}s</td>
                            <td>${{$s[$month]->cost_per_second}}</td>
                            <td>${{number_format($s[$month]->total_cost, 2)}}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach

            <tr>
                <th>Total</th>
                <th></th>
                <th></th>
                <th>{{$total}}</th>
            </tr>
        </table>

    </section>
@endsection
