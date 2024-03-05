<x-app-layout>
    <div class="pagetitle">
        <h1>Users</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">Users</li>
              </ol>
          </nav>
      </div>
      <!-- End Page Title -->
    <section class="section">
        <div class="row">
            <x-alert/>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                            Add New
                        </button>
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">
                                            @php
                                                $count++;
                                                echo $count;
                                            @endphp
                                        </th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @php
                                                $userrole = \App\Models\User::find($user->id)->roles->first()->display_name;
                                                echo $userrole;
                                            @endphp
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUser{{ $user->id }}"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                        <!-- Edit User Modal -->
                                            <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin-users-update', $user->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}" required>
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Check Point</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <label for="inputText" class="col-sm-2 col-form-label">Role:</label>
                                                                    <div class="col-sm-10">
                                                                        <select name="role" class="form-control" required>
                                                                            <option selected disabled>Select Role</option>
                                                                            <option value="1">Admin</option>
                                                                            <option value="2">Artisan</option>
                                                                            <option value="3">User</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End Edit Category Modal-->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Edit User Modal -->
    <div class="modal fade" id="addUser" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin-users-store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Role:</label>
                            <div class="col-sm-10">
                                <select name="role_id" class="form-control" required>
                                    <option selected disabled>Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Artisan</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Username:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Confirm Password:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
