@extends('skeleton.admin.app')

@section('title', 'User | Edit')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">User View</h3>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Name : &nbsp; &nbsp; </th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email : &nbsp; &nbsp; </th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Batch No. : &nbsp; &nbsp; </th>
                                <td>{{ $batch_number }}</td>
                            </tr>
                            <tr>
                                <th>Student ID. : &nbsp; &nbsp; </th>
                                <td>{{ $user->student_id_number }}</td>
                            </tr>
                            <tr>
                                <th>Passing Year : &nbsp; &nbsp; </th>
                                <td>{{ $passing_year }}</td>
                            </tr>
                            <tr>
                                <th>Department : &nbsp; &nbsp; </th>
                                <td>{{ $department }}</td>
                            </tr>
                            <tr>
                                <th>Phone : &nbsp; &nbsp; </th>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address : &nbsp; &nbsp; </th>
                                <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                                <th>Role : &nbsp; &nbsp; </th>
                                <td>{{ $user->role->name }}</td>
                            </tr>
                            <tr>
                                <th>Type : &nbsp; &nbsp; </th>
                                <td>{{ ($user->type == "" && $user->role->name == 'Admin') ? 'Admin' : ucfirst($user->type) }}</td>
                            </tr>
                            <tr>
                                <th>Status : &nbsp; &nbsp; </th>
                                <td>{{ $user->status == 1 ?'Active' : 'Inactive' }}</td>
                            </tr>

                        </table>
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
