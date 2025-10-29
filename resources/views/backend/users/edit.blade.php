@extends('skeleton.admin.app')

@section('title', 'User | Edit')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">User Edit</h3>
                    <div class="card-body">
                        <form action="{{ url('/admin/users', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="">Role</label>

                                <select required style="width: 100%;" class="form-control" name="role_id" id="role_id">
                                    <option value="">--Select--</option>
                                    @foreach($roles as $role)
                                        <option {{ $role->id == $user->role_id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Type</label>
                                <select required style="width: 100%;" class="form-control" name="type" id="type">
                                    <option value="">--Select--</option>
                                    <option {{ $user->type == 'alumni' ? 'selected' : '' }} value="alumni"> Alumni</option>
                                    <option {{ $user->type == 'student' ? 'selected' : '' }} value="student"> Student</option>
                                    <option {{ $user->type == 'faculty' ? 'selected' : '' }} value="faculty"> Faculty</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Active/Inactive User</label>
                                <select required style="width: 100%;" class="form-control" name="status" id="status">
                                    <option value="">--Select--</option>
                                    <option {{ $user->status == 1 ? 'selected' : '' }} value="1"> Active</option>
                                    <option {{ $user->status == 0 ? 'selected' : '' }} value="0"> Inactive</option>
                                </select>
                            </div>


                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
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
