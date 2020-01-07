@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Categories</h3>
                </div>
                @if (in_array('create-categories', $permissions))
                    <div class="col-md-4" style="margin:10px 0">
                        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Category</a>
                    </div>
                @endif
                @if (in_array('read-categories', $permissions))
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @php $i = 1; @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->slug }}</td>
                                @if (empty($category->image))
                                    <td>-</td>
                                @else
                                    <td>
                                        <img width="65" height="65" src="{{ '/images/categories/' .$category->image }}" alt="">
                                    </td>
                                @endif
                                <td>{{ date('d M Y H:i:s', strtotime($category->created_at)) }}</td>
                                <td>
                                    @if (in_array('update-categories', $permissions))
                                        <a href="{{ url("dashboard/categories/$category->id/edit") }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-edit"></i> Edit
                                        </a> |
                                    @endif

                                    @if (in_array('delete-categories', $permissions))
                                        <form style="display:inline;" action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                {{ $categories->links() }}
            </div>
        </div>
    </section>
@endsection
