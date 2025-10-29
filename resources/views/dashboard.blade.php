@extends('skeleton.admin.app')
@section('title', 'Dashboard')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ greeting() }}, {{ userFullName() }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Alumni Portal</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <h5 class="mb-2">Stats</h5>
            <div class="row">
                @if (isAdmin())
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa-solid fa-graduation-cap"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Registed Alumnis</span>
                            <span class="info-box-number">{{ $registeredAlumniCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa-solid fa-school"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Registered Students</span>
                            <span class="info-box-number">{{ $registeredStudentCount }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary">
                            <i class="fa-solid fa-briefcase"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Job Posts</span>
                            <span class="info-box-number">{{ $totalJobPostCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary">
                            <i class="fa fa-tasks"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Job Applications</span>
                            <span class="info-box-number">{{ $totalJobApplicationCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #27ae60; color: white">
                            <i class="fa fa-pen"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Posts</span>
                            <span class="info-box-number">{{ $postCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #e67e22; color: white">
                            <i class="fas fa-comment"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Comments</span>
                            <span class="info-box-number">{{ $commentCount }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon" style="background-color: #8e44ad; color: white">
                            <i class="fas fa-thumbs-up"> </i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Reacts</span>
                            <span class="info-box-number">{{ $reactCount }}</span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
