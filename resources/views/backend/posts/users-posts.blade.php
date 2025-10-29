@extends('skeleton.admin.app')
@section('title', 'Post Lists')
@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users Posts Lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Posts</a></li>
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
                                    <th>Post Content</th>
                                    <th>Post Author</th>
                                    <th style="width: 180px">Create Date</th>
                                    <th style="width: 150px">Approve Status</th>
                                    <th style="width: 91px">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ substr($post->content, 0, 20) }}...</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>
                                            @if ($post->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-warning">In Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/posts/'.$post->id) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ url('admin/posts/'.$post->id) }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
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
                            {{ $posts->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
