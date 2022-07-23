@extends('layouts.app')
@section('title', 'Request List')
@section('content')
    <h1>My Request</h1>
    <a href="{{ route('stuffs.requests.create') }}" class="mb-4 btn btn-primary">Add Request</a>

    {{ $stuffRequests->onEachSide(4)->links() }}
@endsection