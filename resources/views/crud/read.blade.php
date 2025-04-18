<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-krem min-h-screen">
@include('layouts.navigation')

<div class="grid grid-cols-3 gap-4 ml-16 mt-4 mr-4">
    @forelse ($stock as $item)
    <div class="card bg-coklat3 w-96 shadow-xl mb-8 text-white">
        <figure>
          <img class="h-56"
            src="{{ asset('storage/' . $item->image)}}"
            alt="Shoes" />
        </figure>
        <div class="card-body">
          <h2 class="card-title">{{ $item->name }}</h2>
          <p>Harga Barang : {{ $item->harga }}</p>
          <p>Jumlah Barang : {{ $item->jumlah }}</p>
          <p>{{ $item->deskripsi }}</p>
          <div class="card-actions justify-center gap-4 mt-4">

            <form action="{{ route('edit',$item->id) }}" method="POST">
                @csrf
            <input type="hidden" value="{{ $item->id }}">
            <button class="btn btn-white">Edit</button>
            </form>

            <form action="{{ route('delete',$item->id) }}" method="POST">
                @csrf
                <button class="btn btn-error">Delete</button>
            </form>
            </div>
        </div>
    </div>
    @empty
    <p>Tidak ada stock barang</p>
  @endforelse
</div>

</div>
</body>
</html>
