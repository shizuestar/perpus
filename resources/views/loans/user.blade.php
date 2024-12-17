<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Peminjaman Page</h6>
                </div>
                <div class="row">
                    @forelse ($loans as $loan)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 rounded position-relative">
                                <form id="delete-loans-form" method="post">
                                    <div class="position-absolute top-0 end-0" style="transform: translateY(-6px)">
                                        @csrf
                                        @method("DELETE")
                                        <input type="hidden" name="loan_id" value="{{ $loan->id }}">
                                        <i id="delete-loan-btn" 
                                        class="fa fa-x text-danger p-1 rounded-circle cursor-pointer" 
                                        title="Close" data-status="{{ $loan->status }}">
                                        </i>
                                    </div>
                                </form>
                                <div class="card-body p-1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/book/images/' . $loan->book->image) }}" style="transform: scale(.8)" class="img-fluid rounded" alt="">
                                        </div>
                                        <div class="col-md-8 pt-3 ps-0">
                                            <p class="mb-0">{{ $loan->book->title }}</p>
                                            <p class="mb-0">By {{ $loan->book->author }} - {{ $loan->book->publisher }}</p>
                                            <p class="mb-0">Tanggal pinjam : {{ $loan->created_at->locale('id')->isoFormat('dddd, D MMM YYYY') }}</p>
                                            <p class="mb-0">
                                                Tanggal pengembalian : 
                                                @if ($loan->status === 'disetujui' | $loan->status === "dikembalikan" | $loan->status === "terlambat")
                                                    {{ $loan->updated_at->addDays(14)->locale('id')->isoFormat('dddd, D MMM YYYY') }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                            <p class="mb-0">
                                                Status : <span class="{{ $loan->status === "proses" ? "text-warning" : "" }}
                                                                      {{ $loan->status === "disetujui" | $loan->status === "dikembalikan" ? "text-success" : "" }}
                                                                      {{ $loan->status === "terlambat" | $loan->status === "dibatalkan" ? "text-danger" : "" }}"
                                                                       >{{ $loan->status }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Tidak ada data peminjaman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layout>