<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-header pb-0">
                        <h6>Books Table</h6>
                    </div>
                    <button type="button" class="btn btn-primary mb-0 mt-3 me-3" data-bs-toggle="modal" data-bs-target="#modalBook">
                        Add Book
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 3%">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-0">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-0">Author</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-0 overflow-hidden" style="width: 12%">Publisher</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-0 overflow-hidden" style="width: 12%">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-0 overflow-hidden" style="width: 12%">Year Published</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-0 text-center" style="width:8%">Stock</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-0 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                <tr class="text-start">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="ps-0">{{ $book->title }}</td>
                                    <td class="ps-0">{{ $book->author }}</td>
                                    <td class="ps-0">{{ $book->publisher }}</td>
                                    <td class="ps-0">{{ $book->category->name }}</td>
                                    <td class="ps-0">{{ $book->yearPublished }}</td>
                                    <td class="ps-0 text-center {{ $book->loans->count() === $book->stock ? "text-warning" : "text-success" }}">{{ $book->loans->whereIn('status', ['disetujui', 'proses'])->count() }}/{{ $book->stock }}</td>
                                    <td class="text-center">
                                        <button class="mb-0 bg-warning text-white rounded border-0" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editBookModal" 
                                            data-slug="{{ $book->slug }}"
                                            data-title="{{ $book->title }}" 
                                            data-synopsis="{{ $book->synopsis }}" 
                                            data-author="{{ $book->author }}" 
                                            data-excerpt="{{ $book->excerpt }}" 
                                            data-category="{{ $book->category->id }}" 
                                            data-publisher="{{ $book->publisher }}"
                                            data-stock="{{ $book->stock }}"
                                            data-yearPublished="{{ $book->yearPublished }}">
                                            <i class="fa fa-pen-to-square"></i>
                                        </button>
                                        <form action="{{ route('books.destroy', $book->slug) }}" method="POST" id="delete-{{ $book->slug }}" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="showSwal('warning-message-and-cancel', '{{ $book->slug }}');" class="mb-0 bg-danger text-white rounded border-0"><i class="fa fa-trash"></i></button>
                                        </form>
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

    <x-modal>
        <x-slot:title>Add Book</x-slot:title>
        <x-slot:id>modalBook</x-slot:id>
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="excerpt" class="form-label">Excerpt</label>
                <input type="text" name="excerpt" id="excerpt" class="form-control" required placeholder="Enter excerpt's name">
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea name="synopsis" id="synopsis" class="form-control" required placeholder="Enter book synopsis"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="" disabled selected>Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" required placeholder="Enter book stock">
                    </div>
                </div>
            </div>
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
                <label for="formFile" class="form-label">Book Image</label>
                <input name="image" class="form-control" type="file" id="formFile">
              </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal>
    <x-modal-edit>
        <x-slot:id>editBookModal</x-slot:id>
        <form action="" method="POST" id="editBookForm" enctype="multipart/form-data">
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
                <label for="excerpt" class="form-label">Excerpt</label>
                <input type="text" name="excerpt" id="edit-excerpt" class="form-control" required placeholder="Enter excerpt's name">
            </div>
            <div class="mb-3">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea name="synopsis" id="edit-synopsis" class="form-control" required placeholder="Enter book synopsis"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach ($categories as $category)
                                <option class="opt-category" value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="edit-stock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="edit-stock" class="form-control" required placeholder="Enter book stock">
                    </div>
                </div>
            </div>
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
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal-edit>
</x-layout>