<x-library>
    <div>
        <a href="{{ route('library.index') }}" class="btn btn-light shadow rounded position-fixed top-3 start-2">
            <i class="fa fa-arrow-left h4 mb-0"></i>
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="row p-3">
                        <div class="col-md-4 overflow-hidden">
                            <div class="px-2">
                                <img src="{{ asset('storage/book/images/' . $book->image) }}" class="img-fluid rounded"
                                    alt="">
                            </div>
                            {{-- <div class=" bg-info" style="width: 700px; height:700px"></div> --}}
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $book->title }}</h2>
                            <p class="mb-1">By {{ $book->author }}</p>
                            <p class="mb-0">Published by <span class="text-info fw-bold">{{ $book->publisher }}</span>
                                in {{ \Carbon\Carbon::parse($book->yearPublished)->format('F Y') }}</p>

                            <div class="mb-3">
                                @for ($i = 1; $i <= 5; $i++) <i
                                    class="fa fa-star {{ $i <= floor($averageRating) ? 'text-warning' : '' }}"></i>
                                    @endfor
                                    |
                                    <span>{{ number_format($averageRating ?? 0, 1) }} |
                                        {{ $book->bookReviews()->count() }} Review</span>
                            </div>
                            <p>{{ $book->synopsis }}</p>
                            <div class="d-flex justify-content-end">
                                @if($checkCollection->count())
                                <form action="{{ route('library.deleteToCollection') }}" method="POST"
                                    id="delete-collection">
                                    @csrf
                                    <input type="hidden" value="{{ $book->id }}" name="book_id">
                                    <button type="button" class="mb-0 mt-3 btn btn-info px-3 me-3"
                                        onclick="showSwal('warning-message-and-cancel-fav', 'collection')">
                                        <i class="fa fa-check fa-lg text-danger me-1"></i> Favourited
                                    </button>
                                </form>
                                @elseif (Auth::guest())
                                <button class="mb-0 mt-3 btn btn-info px-3 me-3"
                                    onclick="showSwal('warning-message-and-cancel-login', 'To continue this action\nplease login!')">
                                    <i class="fa fa-heart fa-lg text-danger me-1"></i> Favourite
                                </button>
                                @else
                                <form action="{{ route('library.addToCollection') }}" method="POST" class="me-3">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                                    <button type="submit" class="mb-0 mt-3 btn btn-info px-3">
                                        <i class="fa fa-heart fa-lg text-danger me-1"></i> Favourite
                                    </button>
                                </form>
                                @endif
                                @auth
                                <button class="mb-0 mt-3 btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#loanModal" data-title="{{ $book->title }}"
                                    data-slug="{{ $book->slug }}" data-author="{{ $book->author }}"
                                    data-synopsis="{{ $book->synopsis }}" data-publisher="{{ $book->publisher }}"
                                    href="#" {{ $book->status === 'borrowed' ? 'disabled' : '' }}>Request</button>
                                @endauth
                                @guest
                                <button class="mb-0 mt-3 btn btn-primary"
                                    onclick="showSwal('warning-message-and-cancel-login', 'To continue this action\nplease login!')">
                                    Request
                                </button>
                                @endguest
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 px-5">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="fw-bolder m-0">Informasi lain</h4>
                            <i class="fa fa-info-circle d-inline-block h5 m-0 mt-1 ms-3"></i>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <div class="row">
                                <div class="col-4 text-center border-end">
                                    <div class="px-4 py-2 d-inline-block rounded">
                                        <i class="fa fa-hands-bound h4 mb-0"></i><span
                                            class="h4 ms-2">{{ $bookLoanded }}</span><br>
                                        <span class="d-inline-block">Buku dipinjam</span>
                                    </div>
                                </div>
                                <div class="col-4 text-center border-end">
                                    <div class="px-3 py-2 d-inline-block rounded">
                                        <i class="fa fa-hand-holding-heart h4 mb-0"></i><span
                                            class="h4 ms-2">{{ $bookFaved }}</span><br>
                                        <span class="d-inline-block">User menykai buku</span>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="px-4 py-2 d-inline-block rounded">
                                        <i class="fa {{ $bookStock === 0 ? 'fa-x' : 'fa-check' }} h4 mb-0"></i><span
                                            class="h4 ms-2">{{ $bookStock }}</span><br>
                                        <span class="d-inline-block">Buku tersisa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 px-5">
                        <div class="row">
                            <div class="col-10">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="fw-bolder m-0">Review dan Rating Users</h4>
                                    <i class="fa fa-info-circle d-inline-block h5 m-0 mt-1 ms-3"></i>
                                </div>
                                <form action="{{ route('library.book.sendReview', ['book' => $book->slug]) }}"
                                    method="POST">
                                    @csrf
                                    <h6>Berikan Review dan Rating Buku</h6>
                                    <div class="d-flex">
                                        <h6>Rating : </h6>
                                        <div id="icon-stars" class="mb-2 ms-3">
                                            <i class="fa fa-star fa-lg"></i>
                                            <i class="fa fa-star fa-lg"></i>
                                            <i class="fa fa-star fa-lg"></i>
                                            <i class="fa fa-star fa-lg"></i>
                                            <i class="fa fa-star fa-lg"></i>
                                        </div>
                                        <span id="emote" class="ms-3 h5"></span>
                                        <input type="hidden" name="rating" id="rating" value="">
                                        @error('rating')
                                        <div class="text-danger">
                                            Please select our star rating!
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Review</label>
                                        <textarea name="review" id="review" class="form-control" rows="4"
                                            placeholder="Tulis Sak Karepmu..." @guest disabled @endguest
                                            required></textarea>
                                        @error('review')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary" @guest disabled @endguest>
                                        Submit Review
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 px-5">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="mb-0 me-3">Rating dan Review dari User</h5>
                            <button
                                class="py-2 px-2 border-0 rounded-circle shadow-sm d-flex align-items-center justify-content-center"
                                data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="col-md-11">
                            @forelse ($reviews->slice(0,4) as $review)
                            <div class="card-body">
                                <div class="d-flex border-bottom">
                                    {{-- <img src="{{ asset('path/to/user-avatar.png') }}" alt="User Avatar"
                                    class="rounded-circle me-3" style="width: 50px; height: 50px;"> --}}
                                    <i class="fa fa-user-circle h3"
                                        style="transform: translateX(-10px) translateY(-8px)"></i>
                                    <div>
                                        <h6 class="mb-0">{{ $review->user->name }}</h6>
                                        <div class="mb-2">
                                            @for ($i = 1; $i <= 5; $i++) <i
                                                class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : '' }}">
                                                </i>
                                                @endfor
                                                <span class="ms-2">{{ $review->created_at->format('F d, Y') }}</span>
                                        </div>
                                        <p class="pb-2">{{ $review->review }}</p>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted mb-5">Belum ada review, Jadilah yang pertama untuk nya ( Buku )</p>
                            @endforelse
                        </div>
                        <a class="text-info mt-3 cursor-pointer" data-bs-toggle="modal" data-bs-target="#reviewModal">Lihat semua review</a>
                    </div>
                    <div class="row mt-5 px-5 pb-5">
                        <h4 class="fw-bolder mb-3">Buku Serupa</h4>
                        <div class="row">
                            @foreach ($relatedBooks as $relate)
                            <div class="col-md-4 mb-3 @if (($loop->index + 1) % 3 == 2) border-start border-end @endif">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="{{ asset('storage/book/images/' . $relate->image) }}"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="col-7">
                                        <a href="{{ route('library.book.show', $relate->slug) }}">
                                            <h6 class="mb-1">{{ $relate->title }}</h6>
                                            <small>{{ $relate->author }} - <span
                                                    class="fw-bold">{{ $relate->category->name }}</span></small>
                                            <div>
                                                <i class="fa fa-star text-warning"></i> |
                                                {{ $relate->bookReviews->avg('rating') ?? 0,1 }} reviews
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
            <div class="form-group form-check mb-3">
                <input type="checkbox" id="confirm_reset" class="form-check-input" required>
                <label for="confirm_reset" class="form-check-label">
                    I agree to the terms and policies of borrowing at the library
                </label>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Pinjam</button>
            </div>
        </form>
    </x-modal>
    <x-modal>
        <x-slot:title>Semua Review dari Users</x-slot:title>
        <x-slot:id>reviewModal</x-slot:id>
        <x-slot:id>reviewModal</x-slot:id>
        <x-slot:scrollable>modal-dialog-scrollable</x-slot:scrollable>
        <x-slot:size>modal-lg</x-slot:size>
        @forelse ($reviews as $review)
        <div class="card-body">
            <div class="d-flex border-bottom">
                {{-- <img src="{{ asset('path/to/user-avatar.png') }}" alt="User Avatar" class="rounded-circle me-3"
                style="width: 50px; height: 50px;"> --}}
                <i class="fa fa-user-circle h3" style="transform: translateX(-10px) translateY(-8px)"></i>
                <div>
                    <h6 class="mb-0">{{ $review->user->name }}</h6>
                    <div class="mb-2">
                        @for ($i = 1; $i <= 5; $i++) <i
                            class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : '' }}"></i>
                            @endfor
                            <span class="ms-2">{{ $review->created_at->format('F d, Y') }}</span>
                    </div>
                    <p class="pb-2">{{ $review->review }}</p>
                </div>
            </div>
        </div>
        @empty
        <p class="text-muted mb-5">Belum ada review, Jadilah yang pertama untuk nya ( Buku )</p>
        @endforelse
    </x-modal>
</x-library>
