@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Posts</h3>
                </div>
                <div class="col-md-4" style="margin:10px 0">
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Post</a>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>File</th>
                        <th>Comments</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->category_name }}</td>
                            @if ($post->status == 0)
                                <td>Draft</td>
                            @elseif($post->status == 1)
                                <td>Publish</td>
                            @elseif($post->status == 2)
                                <td>Unpublish</td>
                            @endif
                            <td>{{ date('d M Y H:i:s', strtotime($post->created_at)) }}</td>
                            <td><a href="{{ route('files.show', $post->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-file"></i> Files</a></td>
                            <td><a href="{{ route('comments.index', $post->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-comment"></i></a></td>
                            <td>
                                <a href="{{ url("dashboard/posts/$post->id/edit") }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i> Edit
                                </a> |

                                <form style="display:inline;" action="{{ route('posts.destroy', $post->id) }}" method="POST">
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
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
