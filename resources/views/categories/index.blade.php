@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Categories</h3>
                </div>
                <div class="col-md-4" style="margin:10px 0">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>slug</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($category->created_at)) }}</td>
                            <td>
                                <a href="{{ url("categories/$category->id/edit") }}" class="btn btn-success">Edit</a> |

                                <form style="display:inline;" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
