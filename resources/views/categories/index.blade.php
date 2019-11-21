@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <h3>Categories</h3>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Created At</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($category->created_at)) }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
