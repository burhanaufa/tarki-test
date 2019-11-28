@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Users</h3>
                </div>
                <div class="col-md-4" style="margin:10px 0">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($user->created_at)) }}</td>
                            <td><a href="{{ route('user_role.create', $user->id) }}" class="btn btn-primary">Roles</a></td>
                            <td>
                                <a href="{{ url("users/$user->id/edit") }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i> Edit
                                </a> |

                                <form style="display:inline;" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">
                                       <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
