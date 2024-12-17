<div class="row">
    @forelse ($books as $book)
        <div class="col-md-6 mb-4">
            <div class="card h-100"  
            style="position: relative; display: flex; flex-direction: column; min-width: 0; word-wrap: break-word; background-color: #fff; background-clip: border-box; border: 0 solid rgba(0, 0, 0, 0.125); border-radius: 1rem; transition: transform 0.3s ease-in-out;"
            onmouseover="this.style.transform='scale(0.975)'" 
            onmouseout="this.style.transform='scale(1)'">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-4 px-4">
                            <img src="{{ asset('storage/book/images/' . $book->image) }}" class="img-fluid rounded" alt="">
                        </div>
                        <div class="col-md-8">
                            <a href="{{ route('library.book.show', $book->slug) }}">
                                <h5 class="card-title">{{ $book->title }}</h5>
                            </a>
                            <div class="d-flex justify-content-between">
                                <h6 class="card-subtitle text-muted">{{ $book->author }}</h6>
                                <small class="text-info">{{ $book->category->name }}</small>
                            </div>
                            <a href="{{ route('library.book.show', $book->slug) }}">{{ $book->excerpt }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-4 mx-auto mt-5">
            <img src="{{ asset('assets/images/undraw_page_not_found_re_e9o6.svg') }}" alt="">
            <p class="mt-5 text-center">We couldn't find anything that matches <u>{{ request('search') ?? "" }}</u>.</p>
            <p class="text-center">Please try again.</p>
        </div>
    @endforelse
    <div class="row">
        <div class="d-flex justify-content-center">
            <div class="mx-auto">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
