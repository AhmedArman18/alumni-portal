@extends('skeleton.admin.app')

@section('title', 'Users | List')

@section('body')

    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Users List

                        <span>
                        <form action="{{ url('/admin/users/') }}" method="GET">
                            <input style="width: 200px; margin-top: -35px;" placeholder="Search Jobs"
                                   class="float-right form form-control" type="text"
                                   name="search" id="">
                        </form>
                    </span>
                    </h3>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Batch No.</th>
                                <th>Student ID</th>
                                <th>Passing Year</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody style="text-align: center;">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($user->name) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ collect(generateBatchNumbers())->get($user->batch_number) }}</td>
                                    <td>{{ $user->student_id_number }}</td>
                                    <td>{{ collect(generatePassingYears())->get($user->passing_year) }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td>{{ ($user->type == "" && $user->role->name == 'Admin') ? 'Admin' : ucfirst($user->type) }}</td>
                                    @if($user->status == 0)
                                        <td>
                                            <span
                                                style="color: white;font-weight: bold;background: red;padding: 1px 3px;">
                                                Inactive
                                            </span>
                                        </td>
                                    @else
                                        <td>
                                            <span
                                                style="color: white;font-weight: bold;background: green;padding: 1px 3px;">
                                                Active
                                            </span>
                                        </td>
                                    @endif
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                           href="{{ url('/admin/users/view', $user->id) }}">View</a>

                                        @if($user->role->name != 'Admin')
                                        |
                                        <a class="btn btn-sm btn-info"
                                           href="{{ url('/admin/users/edit', $user->id) }}">Edit</a>

                                        @endif
{{--                                        <button id="delete" onclick="document.getElementById({{ $user->id }}).submit();"--}}
{{--                                                class="btn btn-sm btn-danger"--}}
{{--                                        >--}}
{{--                                            Delete--}}
{{--                                        </button>--}}
{{--                                        <form id="{{$user->id}}" method="POST"--}}
{{--                                              action="{{ route('job-board.destroy', $user->id) }}">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                        </form>--}}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div style="margin: 0 auto;">
                {{ $users->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        $(document).ready(function () {
            toastr.options.timeOut = 3000;
            toastr.options.progressBar = true;
            @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
            @endif
        });

    </script>
@endsection
