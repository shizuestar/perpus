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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total semua user</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $users }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Buku</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $books }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Kategori Buku</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $categories }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-list text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total komentar buku</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ $reviews }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa fa-comments text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <x-charts-admin></x-charts-admin>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body pb-2 pt-3">
                            <div class="row">
                                <div class="col-lg-8 text-auto">
                                    <h6 class="mb-0">Peminjaman Hari ini</h6>
                                    <h5 class="font-weight-bolder">{{ $loansD }} <span class="fs-6 text-secondary">Peminjaman</span></h5>
                                </div>
                                <div class="col-lg-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform: scale(1.2)">
                                        <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mt-4">
                    <div class="card">
                        <div class="card-body pb-2 pt-3">
                            <div class="row">
                                <div class="col-lg-8 text-auto pe-0">
                                    <h6 class="mb-0">Peminjaman Bulan ini</h6>
                                    <h5 class="font-weight-bolder">{{ $loansM }} <span class="fs-6 text-secondary">Peminjaman</span></h5>
                                </div>
                                <div class="col-lg-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform: scale(1.2)">
                                        <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 mt-4">
                    <div class="card">
                        <div class="card-body pb-2 pt-3">
                            <div class="row">
                                <div class="col-lg-8 text-auto">
                                    <h6 class="mb-0">Semua Peminjaman</h6>
                                    <h5 class="font-weight-bolder">{{ $loansY }} <span class="fs-6 text-secondary">Peminjaman</span></h5>
                                </div>
                                <div class="col-lg-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md" style="transform: scale(1.2)">
                                        <i class="fa fa-book text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
