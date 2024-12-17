<x-library>
    <div class="row">
        <div class="row d-flex justify-content-center align-items-center mb-4">
            <div class="col-5">
                <form id="searchForm" class="d-flex">
                    <div class="input-group w-100">
                        <span class="input-group-text bg-white border-right-0 rounded-left pr-0">
                            <i class="fa fa-search cursor-pointer"></i>
                        </span>
                        <input type="text" id="searchInput" name="search" class="form-control form-control-me border-start-0 ps-2" placeholder="Cari buku">
                        <button type="submit" class="bg-primary px-3 border-0 rounded-end text-light fw-bold">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="searchResults" class="row">
        @foreach ($books as $book)
            <div class="col-md-6 mb-4">
                <div data-aos="fade-right" class="card rounded"  
                style="position: relative; display: flex; flex-direction: column; min-width: 0; word-wrap: break-word; background-color: #fff; background-clip: border-box; border: 0 solid rgba(0, 0, 0, 0.125); border-radius: 1rem; transition: transform 0.3s ease-in-out;"
                onmouseover="this.style.transform='scale(.975)'" 
                onmouseout="this.style.transform='scale(1)'">
                    <div class="row">
                        <div class="col-md-4" id="image-card-me">
                            <img src="{{ asset('storage/book/images/' . $book->image) }}" class="img-fluid rounded" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body ps-0 p-3KW">
                                <a href="{{ route('library.book.show', $book->slug) }}">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                </a>
                                <div class="d-flex justify-content-between">
                                    <h6 class="card-subtitle text-muted">{{ $book->author }}</h6>
                                    <small class="text-info">{{ $book->category->name }}</small>
                                </div>
                                <div class="">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= floor($book->bookReviews()->avg('rating')) ? 'text-warning' : '' }}"></i>
                                    @endfor
                                    |
                                    <span>{{ number_format($book->bookReviews()->avg('rating') ?? 0, 1) }}</span>
                                </div>
                                <a href="{{ route('library.book.show', $book->slug) }}">{{ $book->excerpt }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="mx-auto">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-modal>
        <x-slot:title>Loan Request</x-slot:title>
        <x-slot:id>loanModal</x-slot:id>
        <h6>Book Data:</h6>
        <p id="title" class="mb-0"></p>
        <p id="author" class="mb-0"></p>
        <p id="publisher" class="mb-0"></p>
        <div class="d-flex mb-3">
            <span>Synopsis : </span>
            <span id="synopsis" class="ms-1"></span>
        </div>
        <form id="loanForm" method="POST">
            @csrf
            {{-- <div class="col-md-6">
                <div class="mb-3">
                    <label for="return_date" class="form-label">Return Date</label>
                    <input type="date" name="return_date" id="return_date" class="form-control" required>
                </div>
            </div> --}}
            <div class="form-group form-check mb-3">
                <input type="checkbox" id="confirm_reset" class="form-check-input" required>
                <label for="confirm_reset" class="form-check-label">
                    I agree to the terms and policies of borrowing at the library
                    {{-- <small>(can be reset again after 3 days)</small> --}}
                </label>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Loan</button>
            </div>
        </form>
    </x-modal>
</x-library>