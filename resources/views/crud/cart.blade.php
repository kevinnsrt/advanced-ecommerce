<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-krem min-h-screen max-h-full text-white">
@include('layouts.navbar')
<div class="overflow-x-auto">
    @forelse ($cart as $item)
    <table class="table ">
      <!-- head -->
      <thead class="text-coklat3">
        <tr>
          <th></th>
          <th>Barang</th>
          <th>Harga</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody class="text-coklat3">
        <!-- row  -->

        <tr>
          <th>{{ $item->id }}</th>
          <td>{{ $item->name }}</td>
          <td>{{ $item->harga }}</td>
          <td>
            <form method="POST" action="{{ route('order',$item->id) }}">
                @csrf
            <input type="number" name="jumlah" class="bg-coklat3 text-krem">
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
        <p class="flex justify-center mt-8 mb-8 text-coklat3">Tidak Ada Barang Pada Cart</p>
      </tbody>
    </table>
    @endforelse
  </div>
</body>
</html>
