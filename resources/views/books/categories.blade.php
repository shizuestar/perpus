<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-header pb-0">
                        <h6>Book Categories</h6>
                    </div>
                    <button type="button" class="btn btn-primary mb-0 mt-3 me-3" data-bs-toggle="modal" data-bs-target="#modalCategory">
                        Add Category
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Slug</th>
                                    <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Category digunakan</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center" style="">{{ $loop->iteration }}</td>
                                    <td>
                                        <h6 class="mb-0 text-sm">{{ $category->name }}</h6>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{ $category->slug }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0 text-center">{{ $category->books()->count() }}</p>
                                    </td>
                                    <td>
                                        <button href="#" class="mb-0 bg-warning text-white rounded border-0" data-bs-toggle="modal"  data-bs-target="#editCategoryModal" data-id="{{ $category->id }}"  data-name="{{ $category->name }}"><i class="fa fa-pen-to-square"></i></button>
                                        <form action="{{ route('book-categories.destroy', $category) }}" method="POST" id="delete-{{ $category->slug }}" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="mb-0 bg-danger text-white rounded border-0" onclick="showSwal('warning-message-and-cancel', '{{ $category->slug }}');"><i class="fa fa-trash"></i></button>
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
        <x-slot:title>Add Category</x-slot:title>
        <x-slot:id>modalCategory</x-slot:id>
        <form action="{{ route('book-categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal>
    <x-modal-edit>
        <x-slot:id>editCategoryModal</x-slot:id>
        <form action="" method="POST" id="editCategoryForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="editName" class="form-label">Category Name</label>
                <input type="text" name="name" id="editName" class="form-control" required>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal-edit>
</x-layout>