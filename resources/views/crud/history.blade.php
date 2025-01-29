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
@include('layouts.navigation')


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
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @forelse ($order as $item)
        <tr>
            <th>{{ $item->id }}</th>
            <td>{{ $item->username }}</td>
            <td>{{ $item->pesanan }}</td>
            <td>{{ $item->harga }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->status }}</td>
            <td>
                @if ($item->status == 'Pending')
                <form method="POST" action="{{ route('proses.order',$item->id) }}">
                    @csrf
                    <input type="hidden" name="status" value="Process">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="username" value="{{ $item->username }}">
                    <input type="hidden" name="pesanan" value="{{ $item->pesanan }}">
                    <input type="hidden" name="harga" value="{{ $item->harga }}">
                    <input type="hidden" name="jumlah" value="{{ $item->jumlah }}">
                <button class="btn btn-primary">
                    Process
                </button>
                </form>
                @elseif($item->status == 'Process')
                <form method="POST" action="{{ route('success.order',$item->id) }}">
                    @csrf
                    <input type="hidden" name="status" value="Success">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="username" value="{{ $item->username }}">
                    <input type="hidden" name="pesanan" value="{{ $item->pesanan }}">
                    <input type="hidden" name="harga" value="{{ $item->harga }}">
                    <input type="hidden" name="jumlah" value="{{ $item->jumlah }}">
                <button class="btn btn-primary">
                    Success
                </button>
                </form>
                @endif

            </td>
          </tr>

        @empty
            <p class="flex justify-center mt-4">Tidak Ada Pesanan Masuk</p>
        @endforelse
      </tbody>
    </table>
  </div>

</body>
</html>
