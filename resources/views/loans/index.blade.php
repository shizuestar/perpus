<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-header pb-0">
                        <h6>Daftar Peminjaman</h6>
                    </div>
                    <button class="btn btn-primary px-3 me-3 mt-3" data-bs-toggle="modal" data-bs-target="#exportModal">
                        <i class="fa fa-file-pdf"></i>
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 3%">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1" style="width: 20%">Peminjam</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">Nama Buku</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1" style="width: 12%">Tanggal Peminjaman</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1" style="width: 12%">Tabggal Pengembalian</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1" style="width: 12%">Status</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1 text-center" style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                <tr class="text-start {{ $loan->status === "terlambat" ? "text-danger" : "" }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $loan->user->name }}</td>
                                    <td>{{ $loan->book->title }}</td>
                                    <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">{{ $loan->return_date ?? "-" }}</td>
                                    <td>{{ $loan->status }}</td>
                                    <td class="text-center {{ $loan->status === "dikembalikan" ? "text-success" : "" }}">
                                        @switch($loan->status)
                                            @case('proses')
                                                <form action="{{ route('loans.acc', $loan->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary btn-sm mb-0">Setuju</button>
                                                </form>
                                                <form action="{{ route('loans.reject', $loan->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-warning btn-sm mb-0">Tolak</button>
                                                </form>
                                                @break
                                            @case('dibatalkan')
                                                <form action="{{ route('loans.acc', $loan->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm mb-0">Returned</button>
                                                </form>
                                                @break
                                            @case('disetujui')
                                                <form action="{{ route('loans.return', $loan->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm mb-0">Returned</button>
                                                </form>
                                                @break
                                            @case('ditolak')
                                                -
                                                @break
                                            @case('dikembalikan')
                                                Selesai
                                                @break
                                            @case('terlambat')
                                                -
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Book Modal -->
    <x-modal>
        <x-slot:title>Add Book</x-slot:title>
        <x-slot:id>modalBook</x-slot:id>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required placeholder="Enter book title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" name="author" id="author" class="form-control" required placeholder="Enter author's name">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea name="synopsis" id="synopsis" class="form-control" required placeholder="Enter book synopsis"></textarea>
            </div>
            {{-- <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" required placeholder="Enter publisher's name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="yearPublished" class="form-label">Year Published</label>
                        <input type="date" name="yearPublished" id="yearPublished" class="form-control" required placeholder="Select publication year">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control" required placeholder="Enter book status">
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal>
    <x-modal-edit>
        <x-slot:id>editBookModal</x-slot:id>
        <form action="" method="POST" id="editBookForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit-id">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="edit-title" class="form-label">Title</label>
                        <input type="text" name="title" id="edit-title" class="form-control" required placeholder="Enter book title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="edit-author" class="form-label">Author</label>
                        <input type="text" name="author" id="edit-author" class="form-control" required placeholder="Enter author's name">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea name="synopsis" id="edit-synopsis" class="form-control" required placeholder="Enter book synopsis"></textarea>
            </div>
            {{-- <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    @foreach ($categories as $category)
                        <option class="opt-category" value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="edit-publisher" class="form-label">Publisher</label>
                        <input type="text" name="publisher" id="edit-publisher" class="form-control" required placeholder="Enter publisher's name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="yearPublished" class="form-label">Year Published</label>
                        <input type="date" name="yearPublished" id="edit-yearPublished" class="form-control" required placeholder="Select publication year">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="edit-status" class="form-label">Status</label>
                <input type="text" name="status" id="edit-status" class="form-control" required placeholder="Enter book status">
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal-edit>
    <x-modal>
        <x-slot:title>Export data peminjaman pdf</x-slot:title>
        <x-slot:id>exportModal</x-slot:id>
        <form action="{{ route('loans.export') }}" method="GET">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Export</button>
            </div>
        </form>
    </x-modal>
</x-layout>