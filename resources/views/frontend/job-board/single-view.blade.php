@extends('skeleton.public.app')

@section('title', 'Job Board')

@push('style')

    <style>
        .job-apply {
            padding: 100px 0;
        }
        .jobs-wrapper {
            /*border: 1px solid #000;*/
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            transition: .4s;
        }


        .jobs-wrapper a {
            color: #000;
            text-decoration: none;
        }

        .jobs-wrapper a:hover {
            color: #000;
            text-decoration: none;
        }
    </style>

@endpush

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Job Post Details View

                        <a href="{{ route('public.jobs.index') }}" class="float-right btn btn-sm btn-primary">Back</a>
                    </h3>
                    <div class="card-body">
                        <div class="job-list">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="jobs-wrapper">
                                        <div class="col-md-12">
                                            <div class="job-title">
                                                <h4 style="color: #348334; font-weight: bold; font-size: 25px;">{{ $jobBoard->title }} </h4>
                                            </div>
                                            <div class="company-name">
                                                <h5 style=" font-weight: bold; font-size: 18px;">
                                                    Company: {{ $jobBoard->company_name }}</h5>
                                            </div>
                                            <div class="job-info">
                                                <p><b>Vacancy: </b> {{ ucfirst($jobBoard->vacancy) }}</p>
                                                <p>
                                                    <span><b>Salary: </b>  {{ $jobBoard->salary }} /= BDT Per Month</span>

                                                </p>

                                                <p><b>Job Responsibilities: </b> {{ ucfirst($jobBoard->description) }}
                                                </p>

                                                <p><b>Job Location: </b> {{ ucfirst($jobBoard->location) }}</p>
                                                <p><b>Employment Status: </b> {{ ucfirst($jobBoard->job_type) }}</p>
                                                <p><b>Educational
                                                        Requirements: </b> {{ ucfirst($jobBoard->education_requirements) }}
                                                </p>
                                                <p><b>Company
                                                        Information: </b> {{ ucfirst($jobBoard->company_information) }}
                                                </p>

                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-3">
                                    <div class=" card-body job-post-information">
                                        <span style="font-size: 14px;">
                                            <b>Job Published On:</b> {{ \Carbon\Carbon::parse($jobBoard->created_at)->format('d M Y')  }}
                                        </span> <br>
                                        <span
                                            style="font-size: 14px;"><b>Job Poster:</b> {{ $jobBoard->user->name }}</span>
                                        <br>
                                        <span style="font-size: 14px;"><b style="color: red; ">Application Deadline: </b>  {{ \Carbon\Carbon::parse($jobBoard->application_deadline)->format('d-M-Y') }}</span>
                                    </div>
                                </div>

                                @if($jobBoard->external_job_link)
                                    <div class="job-apply" style="margin: 0 auto;">
                                        <a target="_blank" href="{{$jobBoard->external_job_link}}" class="btn btn-warning">Direct Job Link</a>
                                    </div>
                                @endif

                                @if ($isAppliedOnThisJob)
                                    <div class="job-apply" style="margin: 0 auto;">
                                        <a class="btn btn-success">You already applied to this job!</a>
                                    </div>
                                @elseif($isDeadlineOver)
                                    <div class="job-apply" style="margin: 0 auto;">
                                        <a class="btn btn-danger">Deadline is over!</a>
                                    </div>
                                @else
                                <div class="job-apply" style="margin: 0 auto;">
{{--                                    <form action="" method="POST">--}}
{{--                                        @csrf--}}
{{--                                        @method('POST')--}}
                                    @if($jobBoard->user_id != auth()->user()->id)
                                    <a href="{{ url('/jobs/'.$jobBoard->id.'/apply?user_id='.auth()->user()->id) }}" class="btn btn-success">Apply</a>
{{--                                    </form>--}}
                                    @endif
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
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
