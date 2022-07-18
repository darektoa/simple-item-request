@extends('layouts.app')
@section('title', 'Item List')
@section('content')
    <h1>Item List</h1>

    {{ $stuffs->onEachSide(4)->links() }}

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Tersedia</th>
            <th scope="col">Satuan</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($stuffs as $stuff)
            @php 
                $page    = $stuffs->currentPage()-1;
                $perPage = $stuffs->perPage();
                $number  = $loop->iteration + ($page * $perPage);
            @endphp
            <tr>
              <th scope="row">{{ $number }}</th>
              <td>{{ $stuff->name }}</td>
              <td>{{ $stuff->stock }}</td>
              <td>{{ $stuff->unitName }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
@endsection