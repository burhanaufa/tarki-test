@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" style="margin:10px 0">
                    <h3>Post Approval</h3>
                </div>
                {{-- @if (in_array('create-posts', $permissions))
                    <div class="col-md-4" style="margin:10px 0">
                    </div>
                @endif --}}
                @if (in_array('read-approval', $permissions))
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        @php $i = 1; @endphp
                        @foreach ($approvals as $approval)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $approval->title }}</td>
                                <td>{{ $approval->category->category_name }}</td>
                                @if ($approval->status == 0)
                                    <td>Draft</td>
                                @elseif($approval->status == 1)
                                    <td>Publish</td>
                                @elseif($approval->status == 2)
                                    <td>Unpublish</td>
                                @endif
                                <td>{{ date('d M Y H:i:s', strtotime($approval->created_at)) }}</td>
                                <td>
                                    @if (in_array('update-approval', $permissions))
                                        @if ($approval->status == 0 or $approval->status == 2)
                                            <form method="post" action="{{ route('approval.post.update', $approval->id) }}" enctype="multipart/form-data" style="display: flex;flex-flow: row wrap;align-items: center;">
                                                @method('POST')
                                                @csrf
                                                <input type="hidden" class="form-control" id="status" name="status" value="1">
                                                <input type="hidden" class="form-control" id="what" name="what" value="post">
                                                <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-flag">&nbspPublish</i></button>
                                            </form>
                                        @elseif($approval->status == 1)
                                        <form method="post" action="{{ route('approval.post.update', $approval->id) }}" enctype="multipart/form-data" style="display: flex;flex-flow: row wrap;align-items: center;">
                                            @method('POST')
                                            @csrf
                                            <input type="hidden" class="form-control" id="status" name="status" value="2">
                                            <input type="hidden" class="form-control" id="what" name="what" value="post">
                                            <button class="btn btn-sm btn-warning" type="submit"><i class="fa fa-flag">&nbspUnpublish</i></button>
                                        </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </table>
                @endif
                {{ $approvals->links() }}
            </div>
        </div>
    </section>
@endsection
