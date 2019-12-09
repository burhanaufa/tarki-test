@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Permissions</h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created At</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($permission->created_at)) }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </table>
                {{ $permissions->links() }}
            </div>
        </div>
    </section>
@endsection
