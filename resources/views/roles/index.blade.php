@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Roles</h3>
                </div>
                @if (in_array('create-roles', $permissions))
                    <div class="col-md-4" style="margin:10px 0">
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add role</a>
                    </div>
                @endif
                @if (in_array('read-roles', $permissions))
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        @php $i = 1; @endphp
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $role->role_name }}</td>
                                <td>{{ date('d M Y H:i:s', strtotime($role->created_at)) }}</td>
                                <td><a href="{{ route('permission_role.create', $role->id) }}" class="btn btn-sm btn-primary">Permissions</a></td>
                                <td>
                                    @if (in_array('update-roles', $permissions))
                                        <a href="{{ url("dashboard/roles/$role->id/edit") }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i> Edit
                                        </a> |
                                    @endif

                                    @if (in_array('delete-roles', $permissions))
                                        <form style="display:inline;" action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </table>
                @endif
                {{ $roles->links() }}
            </div>
        </div>
    </section>
@endsection
