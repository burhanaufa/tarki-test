@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Roles</h3>
                </div>
                <div class="col-md-4" style="margin:10px 0">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">Add role</a>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $role->role_name }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($role->created_at)) }}</td>
                            <td>
                                <a href="{{ url("roles/$role->id/edit") }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i> Edit
                                </a> |

                                <form style="display:inline;" action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
