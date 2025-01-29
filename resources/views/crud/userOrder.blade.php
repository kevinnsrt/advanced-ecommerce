<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@include('layouts.navbar')


<div class="overflow-x-auto">
    <table class="table">
      <!-- head -->
      <thead>
        <tr>
          <th>id</th>
          <th>username</th>
          <th>pesanan</th>
          <th>harga</th>
          <th>jumlah</th>
          <th>Status Pesanan</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @forelse ($order as $item)
        <tr>
            @if ($item->status == 'Success')
            <form action="{{ route('confirm.order',$item->id) }}" method="POST">
                @csrf
            <th>{{ $item->id }}</th>
            <td>{{ $item->username }}</td>
            <td>{{ $item->pesanan }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <input type="hidden" name="status" value="Pesanan Selesai">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="username" value="{{ $item->username }}">
                    <input type="hidden" name="pesanan" value="{{ $item->pesanan }}">
                    <input type="hidden" name="harga" value="{{ $item->harga }}">
                    <input type="hidden" name="jumlah" value="{{ $item->jumlah }}">
                <button class="btn btn-primary">
                    Konfirmasi Pesanan
                </button>
            </form>
            </td>
            @else

            <th>{{ $item->id }}</th>
            <td>{{ $item->username }}</td>
            <td>{{ $item->pesanan }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->status }}</td>
            @endif

          </tr>

        @empty
            <p class="flex justify-center mt-4">Tidak Ada Pesanan Anda</p>
        @endforelse
      </tbody>
    </table>
  </div>

</body>
</html>
