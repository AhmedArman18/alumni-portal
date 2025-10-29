@extends('skeleton.admin.app')

@section('title', 'Job Board | List')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Job Board List

                        <span>
                        <form action="{{ url('/admin/job-board/') }}" method="GET">
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
                                <th>Company Name</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Job Type</th>
                                <th>Salary</th>
                                <th>Location</th>
                                <th>Application Deadline</th>
                                <th>Approve Status</th>
                                <th>Job Posted By</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody style="text-align: center;">
                            @foreach($jobBoardList as $jobBoard)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($jobBoard->company_name) }}</td>
                                    <td>{{ ucfirst($jobBoard->title) }}</td>
                                    <td>{{ \Illuminate\Support\Str::words($jobBoard->description, 20, '...') }}</td>
                                    <td>{{ ucfirst($jobBoard->job_type) }}</td>
                                    <td>{{ $jobBoard->salary }}</td>
                                    <td>{{ ucfirst($jobBoard->location) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jobBoard->application_deadline)->format('d-M-Y') }}</td>
                                    @if($jobBoard->approve_status == 'no')
                                        <td>
                                            <span
                                                style="color: white;font-weight: bold;background: red;padding: 1px 1px;font-size: 12px;">
                                                Pending
                                            </span>
                                        </td>
                                    @else
                                        <td>
                                            <span
                                                style="color: white;font-weight: bold;background: green;padding: 1px 1px;font-size: 12px;">
                                                Published
                                            </span>
                                        </td>
                                    @endif
                                    <td>{{ $jobBoard->user->name }}</td>
                                    <td>
                                        @if (auth()->user()->role->name == "Admin")
                                        <a class="btn btn-sm btn-info"
                                           href="{{ url('/admin/job-board/' .$jobBoard->id. '/edit' ) }}">Edit</a>
                                            @else
                                            <a class="btn btn-sm btn-info"
                                               href="{{ route('job-board.edit', $jobBoard->id) }}">Edit</a>
                                        @endif
                                        |
                                        <button id="delete" onclick="document.getElementById({{ $jobBoard->id }}).submit();"
                                                class="btn btn-sm btn-danger"
                                        >
                                            Delete
                                        </button>

                                        @if (auth()->user()->role->name == "Admin")
                                            <form id="{{$jobBoard->id}}" method="POST"
                                                  action="{{ url('/admin/job-board', $jobBoard->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @else
                                            <form id="{{$jobBoard->id}}" method="POST"
                                                  action="{{ route('job-board.destroy', $jobBoard->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div style="margin: 0 auto;">
                {{ $jobBoardList->appends(request()->except('page'))->links() }}
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
