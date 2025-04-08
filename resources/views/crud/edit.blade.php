<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navigation')
    <div class="flex justify-center mt-28">
    <div>

        <form action="/update/{{ $stock->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $stock->id }}">
          <label class="input input-bordered flex items-center gap-2">
            Nama Barang
            <input type="text" class="grow" name="name" value="{{ old('name',$stock->name) }}" />
          </label>
          <label class="input input-bordered flex items-center gap-2">
           Jumlah Barang
            <input type="number" class="grow" name="jumlah" value="{{ old('jumlah',$stock->jumlah) }}" />
          </label>
          <label class="input input-bordered flex items-center gap-2">
            Harga Barang
             <input type="number" class="grow" name="harga" value="{{ old('harga',$stock->harga) }}" />
           </label>
          <label class="input input-bordered flex items-center gap-2">
            Deskripsi Barang
            <input type="text" class="grow" name="deskripsi" value="{{ old('deskripsi',$stock->deskripsi) }}" />
          </label>
          <input type="file" name="image" class="file-input file-input-bordered w-full"/>
          <div class="flex justify-center mt-6">
            <button class="btn btn-success">
                Edit
            </form>
            </button>
          </div>

    </div>
    </div>
</body>
</html>
