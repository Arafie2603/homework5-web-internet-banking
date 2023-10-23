@extends('layouts.base2')

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

                <!-- Telkomsel -->
                <div class="col-xl-12 col-md-6 mb-4">

                    <div class="card border-left-primary shadow h-100">
                        <div class="card">
                            <div class="card">
                                <div class="card-header">
                                    Informasi Rincian Pembelian
                                </div>
                                <div class="card-body">
                                    <p>Produk: {{ $produk->nama_produk }}</p>
                                    <p>Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="p-4">
                            <form action="{{ url('pembayaran') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                    <div class="form-check">
                                        <input type="radio" id="payment-option1" name="payment" class="form-check-input"
                                            value="saldo">
                                        <label class="form-check-label" for="payment-option1">Saldo</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="payment-option2" name="payment" class="form-check-input"
                                            value="poin">
                                        <label class="form-check-label" for="payment-option2">Poin</label>
                                    </div>
                                    <div class="form-group mt-3">

                                        <input type="number" id="harga" name="harga" placeholder="Masukkan nomor id"
                                            value="{{ $produk->harga }}" class="form-control w-25" required autocomplete="off"
                                            pattern="[0-9]+" maxlength="5" readonly>
                                    </div>
                            
                                <button type="submit" class="btn btn-primary btn-block w-25 mt-2">
                                    Bayar
                                </button>

                            </form>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>


    </div>



    </div>
@endsection
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>

</html>
