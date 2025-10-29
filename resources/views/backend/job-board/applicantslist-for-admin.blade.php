@extends('skeleton.admin.app')

@section('title', 'Job Board | Applicants List')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Job Applicants List - Admin

                        <span>
{{--                        <form action="{{ url('/admin/job-board/') }}" method="GET">--}}
                            {{--                            <input style="width: 200px; margin-top: -35px;" placeholder="Search Jobs"--}}
                            {{--                                   class="float-right form form-control" type="text"--}}
                            {{--                                   name="search" id="">--}}
                            {{--                        </form>--}}
                    </span>
                    </h3>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Company</th>
                                <th>Job Title</th>
                                <th>Deadline</th>
                                <th>Applicants Name</th>
                                <th>Applied Date</th>
                                <th>Resume</th>
                                {{--                                <th>Action</th>--}}
                            </tr>
                            </thead>

                            <tbody style="text-align: center; font-size: 12px;">
                            @foreach($jobApplicantsList as $jobApplicant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst($jobApplicant['company_name']) }}</td>
                                    <td>{{ ucfirst($jobApplicant['job_title']) }}</td>
                                    <td>{{ $jobApplicant['application_deadline'] }}</td>
                                    <td>{{ $jobApplicant['applicants_name'] }}</td>
                                    <td>{{ $jobApplicant['applied_date'] }}</td>
                                    <td>
                                        <a href="{{ url("admin/download-applicants-cv-list?file=".$jobApplicant['resume_path']) }}">
                                            <i class="fa fa-download"></i></a>
                                    </td>
                                    {{--                                    <td>--}}
                                    {{--                                        <a class="btn btn-sm btn-info"--}}
                                    {{--                                           href="{{ route('job-board.edit', $jobApplicant['id']) }}">Edit</a>--}}
                                    {{--                                        |--}}
                                    {{--                                        <button id="delete" onclick="document.getElementById({{ $jobApplicant['id'] }}).submit();"--}}
                                    {{--                                                class="btn btn-sm btn-danger"--}}
                                    {{--                                        >--}}
                                    {{--                                            Delete--}}
                                    {{--                                        </button>--}}
                                    {{--                                        <form id="{{$jobApplicant['id']}}" method="POST"--}}
                                    {{--                                              action="{{ route('job-board.destroy', $jobApplicant['id']) }}">--}}
                                    {{--                                            @csrf--}}
                                    {{--                                            @method('DELETE')--}}
                                    {{--                                        </form>--}}

                                    {{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div style="margin: 0 auto;">
                {{--                {{ $jobBoardList->appends(request()->except('page'))->links() }}--}}
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
