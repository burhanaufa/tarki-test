@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Files</h3>
                </div>
                <div class="col-md-4" style="margin:10px 0">
                    <a href="{{ route('files.create', $post_id) }}" class="btn btn-primary">Add file</a>
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>File</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    @php $i = 1; @endphp
                    @foreach ($files as $file)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                @if ($file->file_format == 'img')
                                    <img width="65" height="65" src="{{ env('APP_URL'). '/images/posts/' .$file->file_name }}" alt="">
                                @else
                                    {{ $file->file_name }}
                                @endif
                            </td>
                            <td>{{ date('d M Y H:i:s', strtotime($file->created_at)) }}</td>
                            <td>
                                <form style="display:inline;" action="{{ route('files.destroy', ['id' => $file->id, 'post_id' => $file->post_id]) }}" method="POST">
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
                {{ $files->links() }}
            </div>
        </div>
    </section>
@endsection
