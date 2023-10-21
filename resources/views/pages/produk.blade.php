@extends('layouts.base')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Kategori Produk</h1>
    <!-- DataTales Example -->

    {{-- <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar User 69 Wallet</h6>
    </div> --}}

    {{-- ===== Button TAMBAH DATA ===== --}}

    <!-- Button trigger modal -->

    <div class="container-fluid p-0">
        <div class="row">
            @foreach ($produk as $pd)
                <div class="col-lg-6">
                    <form action="{{ url('warung/tambah') }}" method="POST">
                        @csrf

                        <div class="card p-3 pt-4 pb-4">
                            <div class="d-flex align-items-center" style="height: 100px">
                                @if ($pd->status == 'Kosong')
                                    <div class="p-2">
                                        <img class="flex-shrink-0 img-thumbnail rounded produk img-fluid"
                                            src="{{ asset('storage/storage/' . $pd->foto_produk) }}"
                                            alt="" style="width: 120px;filter: grayscale(100%)">
                                    </div>
                                @else
                                    <div class="p-2">
                                        <img class="flex-shrink-0 img-thumbnail rounded produk img-fluid"
                                            src="{{ asset('storage/storage/' . $pd->foto_produk) }}"
                                            alt="" style="width: 120px">
                                    </div>
                                @endif




                                <div class="p-2">
                                    <span>{{ $pd->nama_produk }}</span>
                                    <input type="hidden" name="nama" value="{{ $pd->nama_produk }}">
                                    <span class="text-primary">Rp{{ number_format($pd->harga) }}</span>
                                </div>


                                <div class="p-2 ml-2" style="margin-left: auto !important">
                                    @if ($pd->status == 'Kosong')
                                        <button disabled type="submit" style="width: 140px"
                                            class="btn btn-secondary tombol"><i
                                                class="fas fa-fw fa-x"></i><span class="keranjang">
                                                Kosong</span></button>
                    
                                        {{-- @if (in_array($namaproduk, $db))
                                            <button disabled type="submit" style="width: 140px"
                                                class="btn btn-success tombol"><i
                                                    class="fas fa-fw fa-check"></i><span
                                                    class="keranjang"> Ditambahkan</span></button>
                                        @else
                                            <button type="submit" style="width: 140px"
                                                class="btn btn-primary tombol"><i
                                                    class="fas fa-fw fa-add"></i><span class="keranjang">
                                                    Keranjang</span></button>
                                        @endif --}}
                                    @endif


                                </div>
                    </form>





                </div>
            @endforeach
        </div>

    </div>


</div>
@endsection