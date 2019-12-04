@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Regions</h3>
                </div>
                <div class="col-md-4" style="margin:10px 0">
                    <a href="{{ route('regions.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Region</a>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>URL</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($regions as $region)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $region->region_name }}</td>
                            @if (empty($region->icon))
                                <td>-</td>
                            @else
                                <td>
                                    <img width="65" height="65" src="/images/icons/{{ $region->icon }}" alt="">
                                </td>
                            @endif
                            <td>{{ $region->url }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($region->created_at)) }}</td>
                            <td>
                                <a href="{{ url("dashboard/regions/$region->id/edit") }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i> Edit
                                </a> |

                                <form style="display:inline;" action="{{ route('regions.destroy', $region->id) }}" method="POST">
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
                {{ $regions->links() }}
            </div>
        </div>
    </section>
@endsection
