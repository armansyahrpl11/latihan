@extends('layouts.admin')

@section('title')
Detail Pengaduan
@endsection

@section('content')
<main class="h-full pb-16 overflow-y-auto">
  <div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-center text-gray-700 dark:text-gray-200">
      Detail Pengaduan
    </h2>


    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
        @foreach($item->details as $ite)
        <div
          class="text-gray-800 text-sm font-semibold px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 ">

          <h2>Nama : {{ $ite->name }}</h2>
          <h2 class="mt-4">NIK : {{ $ite->user_nik }}</h2>
          <h2 class="mt-4">No Telepon : {{ $item->user->phone }}</h2>
          <h2 class="mt-4">Tanggal : {{ $ite->created_at->format('l, d F Y - H:i:s') }}</h2>
          <h2 class="mt-4">Status :
            @if($item->status =='Belum di Proses')
            <span
                  class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-md dark:text-red-100 dark:bg-red-700">
                  {{ $item->status }}
            </span>
            @elseif ($item->status =='Sedang di Proses')
            <span
                  class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-md dark:text-white dark:bg-orange-600">
                  {{ $item->status }}
            </span>
            @else
            <span
                  class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-md dark:bg-green-700 dark:text-green-100">
                  {{ $item->status }}
                </span>
            @endif
          </h2>
        </div>

        <div class="px-4 py-3 mb-8 flex text-gray-800 bg-white rounded-lg shadow-md dark:bg-gray-800">
          <div class="relative hidden mr-3  md:block dark:text-gray-400">
            <h1 class="text-center mb-8 font-semibold">Foto</h1>
            <img class=" h-32 w-35 " src="{{ Storage::url($item->image) }}" alt="" loading="lazy" />
          </div>
          <div class="text-center flex-1 dark:text-gray-400">
            <h1 class="mb-8 font-semibold">Keterangan</h1>
            <p class="text-gray-800 dark:text-gray-400">
              {{ $item->description}}
            </p>
          </div>
        </div>
        @endforeach
        <div class="px-4 py-3 mb-8 flex bg-white rounded-lg shadow-md dark:text-gray-400   dark:bg-gray-800">

          <div class="text-center flex-1">
            <h1 class="mb-8 font-semibold">Tanggapan</h1>
            <p class="text-gray-800 dark:text-gray-400">
              @if (empty($tangap->tanggapan))
              Belum ada tanggapan
              @else
              {{ $tangap->tanggapan}}
              @endif
            </p>
          </div>

        </div>
        <main class="h-full pb-16 overflow-y-auto">
            <div class="container px-6 mx-auto grid">
              <h2 class="my-6 text-2xl text-center font-semibold text-gray-700 dark:text-gray-200">
                Berikan Tanggapan
              </h2>
              <form action="{{ route('tanggapan.store')}} " method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pengaduan_id" value="{{ $item->id }} ">
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                  <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Tanggapan</span>
                    <textarea
                      class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                      rows="8" type="text" placeholder="Isi Tanggapan Anda" value="{{ old('description')}}"
                      name="tanggapan"></textarea>
                  </label>

                  <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Status</span>

                    <select
                      class="block w-full text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-red-400 focus:outline-none focus:shadow-outline-red dark:focus:shadow-outline-gray"
                      name="status">
                      <option value="Belum di Proses">Belum di Proses</option>
                      <option value="Sedang di Proses">Sedang di Proses</option>
                      <option value="Selesai">Selesai</option>

                    </select>
                  </label>


                  <button type="submit"
                    class="mt-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    Tanggapi
                  </button>
                </div>
              </form>
            </div>
          </main>
      </div>
      <div class="flex justify-center my-4">
        <a href="{{ url('admin/pengaduan/cetak', $item->id)}}"
          class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
          Export ke PDF
        </a>
      </div>
      <div class="flex justify-center my-6">
        <a href="{{ route('tanggapan.show', $item->id)}}"
          class="px-5 py-3 font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
          Berikan Tanggapan
        </a>
      </div>
    </div>

</main>
@endsection
