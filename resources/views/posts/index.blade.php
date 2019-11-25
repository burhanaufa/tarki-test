@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Posts</h3>
                </div>
                <div class="col-md-4" style="margin:10px 0">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Headline</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{!! $post->headline !!}</td>
                            <td>{{ $post->category->category_name }}</td>
                            @if ($post->status == 0)
                                <td>Draft</td>
                            @elseif($post->status == 1)
                                <td>Publish</td>
                            @elseif($post->status == 2)
                                <td>Unpublish</td>
                            @endif
                            <td>{{ date('d M Y H:i:s', strtotime($post->created_at)) }}</td>
                            <td>
                                <a href="{{ url("posts/$post->id/edit") }}" class="btn btn-sm btn-success">
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
            </div>
        </div>
    </section>
@endsection
