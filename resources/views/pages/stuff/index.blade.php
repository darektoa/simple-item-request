@extends('layouts.app')
@section('title', 'Item List')
@section('content')
    <h1>Item List</h1>
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
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $stuff->name }}</td>
              <td>{{ $stuff->stock }}</td>
              <td>{{ $stuff->unitName }}</td>
            </tr>
            @endforeach

        </tbody>
      </table>
@endsection