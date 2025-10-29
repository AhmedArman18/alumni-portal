@extends('skeleton.admin.app')
@section('title', 'Post Lists')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Job Applications List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Job Application</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @includeIf('skeleton.admin.partials.alerts')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                            {{-- <form action="{{ route('posts.index') }}" method="GET" class="form-inline float-right">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                        aria-label="Search" name="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar bg-success text-light" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <a href="{{ route('posts.index') }}" class="btn btn-navbar bg-warning text-light">
                                            <i class="fas fa-sync"></i>
                                        </a>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Company</th>
                                    <th>Job Titile</th>
                                    <th>Application Deadline</th>
                                    <th style="width: 180px">Applied Date</th>
                                    <th style="width: 180px">Job URL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($jobApplications as $jobApplication)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jobApplication->jobBoard->company_name }}</td>
                                        <td>{{ $jobApplication->jobBoard->title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jobApplication->jobBoard->application_deadline)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jobApplication->applied_date)->format('d-m-Y') }}</td>
                                        <td><a target="_blank" href="{{ url('/jobs', $jobApplication->jobBoard->id) }}">Visit Job Post</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $jobApplications->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
