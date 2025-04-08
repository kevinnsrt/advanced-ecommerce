<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-krem text-white h-screen">
    @include('layouts.navigation')
    <div class="flex justify-center mt-28">
    <div>
        <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <label class="input input-bordered flex items-center gap-2 mb-4 bg-coklat3 border-b">
            Nama Barang
            <input type="text" class="grow" name="name" />
          </label>
          <label class="input input-bordered flex items-center gap-2 mb-4 bg-coklat3 border-b">
           Jumlah Barang
            <input type="number" class="grow" name="jumlah" />
          </label>
          <label class="input input-bordered flex items-center gap-2 mb-4 bg-coklat3 border-b">
            Harga Barang
             <input type="number" class="grow" name="harga" />
           </label>
          <label class="input input-bordered flex items-center gap-2 mb-4 bg-coklat3 border-b">
            Deskripsi Barang
            <input type="text" class="grow" name="deskripsi" />
          </label>
          <input type="file" name="image" class="file-input file-input-bordered w-full bg-coklat3 " />

          <div class="flex justify-center mt-6">
            <button class="btn btn-success">
                Create
            </form>
            </button>
          </div>
    </div>
    </div>
</body>
</html>
