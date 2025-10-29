@extends('skeleton.admin.app')
@section('title', 'Post | Edit')
@section('body')
    <div class="container">
        <div class="row">
            @includeIf('skeleton.admin.partials.alerts')
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Post Edit</h3>
                    <div class="card-body">
                        <form action="{{ url('/admin/posts', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Author Name</label>
                                <input type="text" class="form-control"  value="{{ $post->user->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Active/Inactive post</label>
                                <select required style="width: 100%;" class="form-control" name="status" id="status">
                                    <option value="">--Select--</option>
                                    <option {{ $post->status == 1 ? 'selected' : '' }} value="1"> Active</option>
                                    <option {{ $post->status == 0 ? 'selected' : '' }} value="0"> Inactive</option>
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ url('admin/posts/') }}" class="btn btn-danger">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
