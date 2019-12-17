@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Comments</h3>
                </div>
                @if (in_array('read-comments', $permissions))
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Blog</th>
                            <th>Comment</th>
                            <th>Reply</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @php $i = 1; @endphp
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $comment->full_name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td>{{ $comment->blog }}</td>
                                <td>
                                    <p>
                                        {{ strlen($comment->comment) > 50 ? substr($comment->comment,0,50)."..." : $comment->comment }}
                                    </p>
                                    @if (!empty($comment->comment_reply))
                                        <blockquote class="text-danger">
                                            {!! strlen($comment->comment_reply) > 50 ? substr($comment->comment_reply,0,50)."..." : $comment->comment_reply !!}
                                        </blockquote>
                                    @endif
                                </td>
                                @if (empty($comment->comment_reply))
                                    <td>
                                        @if (in_array('update-comments', $permissions))
                                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary">Balas</a>
                                        @endif
                                    </td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>{{ date('d M Y H:i:s', strtotime($comment->created_at)) }}</td>
                                <td>
                                    @if (in_array('delete-comments', $permissions))
                                        <form style="display:inline;" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
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
                {{ $comments->links() }}
            </div>
        </div>
    </section>
@endsection
