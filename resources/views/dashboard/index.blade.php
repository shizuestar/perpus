<x-layout>
    <div class="row">
        <div class="card p-3 ps-5">
            <div class="row">
                <div class="col-md-2">
                    <img src="{{ asset('assets/images/undraw_welcome_cats_thqn.svg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                    <h3 class="mt-4">Welcome back, {{ Auth::user()->name }} 👋</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body py-3 pb-2">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Peminjaman saya</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $loans }}
                                    <span class="text-sm text-secondary">Peminjaman</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform: scale(1.2)">
                                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body py-3 pb-2">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Koleksi Buku</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $favourites }}
                                    <span class="text-sm text-secondary">Buku</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform: scale(1.2)">
                                <i class="fa fa-list text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body py-3 pb-2">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Partisipasi Review</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $comments }}
                                    <span class="text-sm text-secondary">Review</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform: scale(1.2)">
                                <i class="fa fa-comments text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <h4>Semua Status Peminjaman</h4>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body py-3 text-warning">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Proses</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $loansP }}
                                    <span class="text-sm text-secondary">Peminjaman</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform:translateY(5px)" >
                                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body py-3 text-success">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Disetujui</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $loansA }}
                                    <span class="text-sm text-secondary">Peminjaman</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform:translateY(5px)" >
                                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body py-3 text-success">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Dikembalikan</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $loansR }}
                                    <span class="text-sm text-secondary">Peminjaman</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform:translateY(5px)" >
                                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body py-3 text-danger">
                    <div class="row">
                        <div class="col-9 pe-0">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Dikembalikan Terlambat</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $loansRL }}
                                    <span class="text-sm text-secondary">Peminjaman</span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform:translateY(5px)" >
                                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
