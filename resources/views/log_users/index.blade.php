@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Log Users</h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Description</th>
                        <th>Created At</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($log_users as $log_user)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $log_user->ip_address }}</td>
                            <td>{{ $log_user->user_agent }}</td>
                            <td>{{ $log_user->description }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($log_user->created_at)) }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </table>
                {{ $log_users->links() }}
            </div>
        </div>
    </section>
@endsection
