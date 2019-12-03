@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Configurations</h3>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($configurations as $configuration)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $configuration->config_name }}</td>
                            <td>{!! $configuration->description !!}</td>
                            @if (empty($configuration->image))
                                <td>-</td>
                            @else
                                <td>
                                    <img width="65" height="65" src="{{ env('APP_URL'). '/images/configurations/' .$configuration->image }}" alt="">
                                </td>
                            @endif
                            <td>{{ date('d M Y H:i:s', strtotime($configuration->created_at)) }}</td>
                            <td>
                                <a href="{{ url("dashboard/configurations/$configuration->id/edit") }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </table>
                {{ $configurations->links() }}
            </div>
        </div>
    </section>
@endsection
