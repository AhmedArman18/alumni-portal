@extends('skeleton.admin.app')

@section('title', 'Donation Lists')

@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Donation Lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.index') : route('alumni.donations.index') }}">
                                Donations
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
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
                            <a href="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.create') : route('alumni.donations.create') }}"
                               class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create New Donation
                            </a>

                            <form action="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.index') : route('alumni.donations.index') }}"
                                  method="GET" class="form-inline float-right">
                                <div class="input-group input-group-sm">
                                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                           aria-label="Search" name="search" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-navbar bg-success text-light" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <a href="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.index') : route('alumni.donations.index') }}"
                                           class="btn btn-navbar bg-warning text-light">
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
                                        <th>Bkash/Nagad Number</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Create Date</th>
                                        <th style="width: 91px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($donations as $donation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $donation->title }}</td>
                                            <td>{{ $donation->contact_number }}</td>
                                            <td>{{ $donation->amount ? 'BDT ' . number_format($donation->amount, 2) : 'N/A' }}</td>
                                            <td>
                                                <span class="badge {{ $donation->status == 'active' ? 'badge-success' : 'badge-warning' }}">
                                                    {{ $donation->status_label }}
                                                </span>
                                            </td>
                                            <td>{{ $donation->create_date }}</td>
                                            <td>
                                                @if (auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN)
                                                     <a href="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.edit', $donation->id) : route('alumni.donations.edit', $donation->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.destroy', $donation->id) : route('alumni.donations.destroy', $donation->id) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this donation?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @else
                                                -
                                                @endif
                                            
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No donations found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $donations->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection