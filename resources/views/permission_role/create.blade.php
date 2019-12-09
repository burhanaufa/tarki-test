@extends('layouts.dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <h3>Permission Role</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('permission_role.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="role_id" value="{{ $role_id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        value="{{ $permission->id }}" id="{{ $permission->name }}"
                                                        name="permissions[]" {{ in_array($permission->id, $permission_id) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="{{ $permission->name }}">{{ $permission->name }}</label>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" style="margin:10px 0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $(".btn-success").click(function(){
                var html = $(".clone").html();
                $(".increment").before(html);
            });

        });
    </script>
@endpush
