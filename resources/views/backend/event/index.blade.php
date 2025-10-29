@extends('skeleton.admin.app')
@section('title', 'Event Lists')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Event Lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Events</a></li>
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
                @error('search')
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                        </div>
                    </div>
                @enderror
                @includeIf('skeleton.admin.partials.alerts')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('events.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Event</a>

                            <form action="{{ route('events.index') }}" method="GET" class="form-inline float-right">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                        aria-label="Search" name="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar bg-success text-light" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <a href="{{ route('events.index') }}" class="btn btn-navbar bg-warning text-light">
                                            <i class="fas fa-sync"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 10px">#</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Duration</th>
                                        <th>Location</th>
                                        <th>Create Date</th>
                                        {{-- <th style="width: 10px">Approve Status</th> --}}
                                        <th style="width: 91px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->type }}</td>
                                            <td>{{ $event->start_at }}</td>
                                            <td>{{ $event->end_at }}</td>
                                            <td>{{ $event->duration }}</td>
                                            <td>{{ $event->location }}</td>
                                            <td>{{ $event->create_date }}</td>
                                            {{-- <td>
                                                @if ($event->approve_status == 1)
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('events.edit', $event->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $events->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
