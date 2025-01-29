<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navbar')

    <div class="grid grid-cols-3 gap-4 ml-16 mt-4 mr-4">
        @forelse ($stock as $item)
        <div class="card bg-base-100 w-96 shadow-xl">
            <figure>
              <img class="h-56"
                src="{{ asset('storage/' . $item->image)}}"
                alt="Shoes" />
            </figure>
            <div class="card-body">
                <form method="POST" action="/cart/{{ $item->id }}">
                    @csrf
              <h2 class="card-title">{{ $item->name }}</h2>
              <p>Harga Barang: {{ $item->harga }}</p>
              <p>{{ $item->deskripsi }}</p>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" name="id" value="{{ $item->id }}">
                <input type="hidden" name="name" value="{{ $item->name }}">
                <input type="hidden" name="harga" value="{{ $item->harga }}">
                <div class="mt-4 flex justify-center gap-4">
                <div class="card-actions justify-center gap-4">
                    <button class="btn btn-success">Buy</button>
              </form>
                </div>
              </div>
                </div>
        </div>
        @empty
        <p>Tidak ada stock barang</p>
      @endforelse
    </div>

</body>
</html>
