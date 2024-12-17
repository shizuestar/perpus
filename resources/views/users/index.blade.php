<x-layout>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="card-header pb-0">
                        <h6>Users table</h6>
                    </div>
                    <button type="button" class="btn btn-primary mb-0 mt-3 me-3" data-bs-toggle="modal" data-bs-target="#modalUser">
                        Add User
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="myTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-2 text-center" style="width: 3%">#</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        User</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Alamat</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Pinjam</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telepon</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class=" flex-column">
                                                @if ($user->level == "admin")
                                                    <h6 class="badge badge-sm bg-gradient-success text-start d-inline-block">{{ $user->name }}</h6>
                                                @else
                                                    <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                @endif
                                                <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->address ?? "Not Attached" }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->loans()->count() ?? "Not Attached" }}</p>
                                    </td>
                                    <td class="align-middle text-start text-sm">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->telp ?? "Not Attached" }}</p>
                                    </td>
                                    <td>
                                        <button href="#" class="mb-0 bg-warning text-white rounded border-0" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUserModal" 
                                            data-id="{{ $user->id }}" 
                                            data-name="{{ $user->name }}" 
                                            data-username="{{ $user->username }}" 
                                            data-email="{{ $user->email }}" 
                                            data-address="{{ $user->address }}" 
                                            data-level="{{ $user->level }}"><i class="fa fa-pen-to-square"></i></button>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" id="delete-{{ $user->id }}" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="mb-0 bg-danger text-white rounded border-0" onclick="showSwal('warning-message-and-cancel', '{{ $user->id }}');">
                                                <i class="fa fa-trash"></i>
                                            </button>
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
        <x-slot:title>Add Users</x-slot:title>
        <x-slot:id>modalUser</x-slot:id>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Enter address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select name="level" id="level" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal>
    <x-modal-edit>
        <x-slot:id>editUserModal</x-slot:id>
        <form action="" method="POST" id="editUserForm">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control" placeholder="Enter address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select name="level" id="level" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </x-modal-edit>
</x-layout>