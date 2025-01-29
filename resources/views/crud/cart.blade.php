<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('layouts.navbar')
<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Barang</th>
          <th>Harga</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <!-- row  -->
        @forelse ($cart as $item)
        <tr>
          <th>{{ $item->id }}</th>
          <td>{{ $item->name }}</td>
          <td>{{ $item->harga }}</td>
          <td>
            <form method="POST" action="{{ route('order',$item->id) }}">
                @csrf
            <input type="number" name="jumlah">
          </td>
          {{-- <td>{{ $item->jumlah }}</td> --}}
          <td>
                <input type="hidden" name="status" value="Pending">
                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="username" value="{{ auth()->user()->name}}">
                <input type="hidden" name="pesanan" value="{{ $item->name }}">
                <input type="hidden" name="harga" value="{{ $item->harga }}">
            <button class="btn btn-success">
                Checkout
            </button>
        </form>
          </td>
          <td>
            <form method="POST" action="{{ route('delete.cart',$item->id) }}">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
            <button class="btn btn-error">
                Delete
            </button>
            </form>
          </td>
        </tr>
        @empty
        <p class="flex justify-center mt-8 mb-8">Tidak Ada Barang Pada Cart</p>
        @endforelse
      </tbody>
    </table>
  </div>
</body>
</html>
