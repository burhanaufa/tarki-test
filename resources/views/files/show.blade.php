@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Files</h3>
                </div>
                @if (in_array('create-files', $permissions))
                    <div class="col-md-4" style="margin:10px 0">
                        <a href="{{ route('files.create', $post_id) }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add file</a>
                    </div>
                @endif
                @if (in_array('read-files', $permissions))
                    <table class="table table-striped">
                        <form method="post" action="{{ route('files.update', $post_id) }}">
                            @method('PATCH')
                            @csrf
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>
                                    Is Cover?
                                    @if (in_array('update-files', $permissions))
                                        <button name="set_is_cover" id="btn-set-is-cover" class="btn btn-sm btn-primary">Save</button>
                                    @endif
                                </th>
                                <th>Created At</th>
                                <th>
                                    Delete
                                    @if (in_array('delete-files', $permissions))
                                        <button name="delete" id="btn-delete" class="btn btn-sm btn-success">Delete</button>
                                    @endif
                                </th>
                            </tr>
                            @php $i = 1; @endphp
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        @if ($file->file_format == 'img')
                                            <img width="65" height="65" src="{{ '/images/posts/' .$file->file_name }}" alt="">
                                        @else
                                            {{ $file->file_name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($file->is_cover == 0)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_cover"
                                                    id="is_cover{{$i}}" value="{{$file->id}}">
                                            </div>
                                        @else
                                            <h4><span class="badge badge-info">Cover</span></h4>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y H:i:s', strtotime($file->created_at)) }}</td>
                                    <td>
                                        <input type="checkbox" value="{{ $file->id }}" id="{{ $file->file_name }}"
                                                name="deletes[]">
                                        {{-- <form id="delete" style="display:inline;" action="{{ route('files.destroy', ['id' => $file->id, 'post_id' => $file->post_id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" id="btn-delete" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form> --}}
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        </form>
                    </table>
                @endif
                {{ $files->links() }}
            </div>
        </div>
    </section>
@endsection
