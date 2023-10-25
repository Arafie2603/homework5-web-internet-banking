@extends('layouts.base')

@section('content')
    <div class="container-fluid">

        {{-- ===== DASHBOARD USER ===== --}}

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Hai, {{ session('name') }}</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow py-2 h-150">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-4">
                                    <h4 class="font-weight-bold">Saldo</h4> </div>

                                @if ($user->akun->saldo == 0)
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp. {{ number_format(0, 0, ',', '.') }}
                                    </div>
                                @else
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp. {{ number_format($user->akun->saldo, 0, ',', '.') }}
                                    </div>
                                @endif


                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">

                                <div class="text-xs font-weight-bold text-success mb-4">
                                    <h4 class="font-weight-bold">Poin</h4></div>
                                @if ($user->akun->poin == 0)
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        0
                                    </div>
                                @else
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $user->akun->poin }}
                                    </div>
                                @endif



                            </div>
                            {{-- <div class="col-auto">
                                <i class="fas fa-donate fa-2x text-gray-300"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>



            <!-- Earnings (Monthly) Card Example -->
        </div>
    </div>
@endsection
