@extends('layouts.app')
@section('title', 'Request List')
@section('content')
    <div class="d-flex align-items-center mb-4">
        <h1>Request</h1>
        <a href="{{ route('stuffs.requests.create') }}" class="ms-auto d-block btn btn-primary">Add Request</a>
    </div>

    {{ $stuffRequests->onEachSide(4)->links() }}

    <table class="table">

        @foreach ($stuffRequests as $request)
        @php 
            $page    = $stuffRequests->currentPage()-1;
            $perPage = $stuffRequests->perPage();
            $number  = $loop->iteration + ($page * $perPage);
        @endphp
            <tr>
                <th scope="row"># {{ $number }}</th>
                <th>{{ $request->user->name }}</th>
                <th>{{ $request->created_at->format('Y/m/d') }}</th>
            </tr>
            <tr>
                <td colspan="3">
                    <table class="table mb-5">

                        @foreach ($request->stuffs as $stuff)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $stuff->name }} ({{ $stuff->pivot->quantity }} {{ $stuff->unitName }})</td>
                        </tr>
                        @endforeach

                    </table>
                </td>
            </tr>
        @endforeach

    </table>
@endsection