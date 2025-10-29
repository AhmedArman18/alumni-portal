@extends('skeleton.public.app')
@push('style')
    <style>
        .status-box {
            font-size: 1.3rem;
            height: 60px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }
    </style>
@endpush
@section('body')
    <div class="content">
        <div class="container">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <h2 style="margin: 20px 0;" class="text-center">Registered Alumni</h2>

                    <div class="row my-2">

                        @foreach($alumni as $data)
                            <div class="col-md-4">
                                <div class="card" style="padding-top: 10px">
                                    @if($data->avatar)
                                        <img class="card-img-top"
                                             style="border: 1px solid #000; width: 300px; height: 250px; margin: 0 auto;"
                                             src="{{ asset("img/profile/".$data->avatar) }}" alt="Card image cap">
                                    @else
                                    <img class="card-img-top"
                                         style="border: 1px solid #000; width: 300px; height: 250px; margin: 0 auto;"
                                         src="{{ asset('img/user2-160x160.jpg') }}" alt="Card image cap">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Name: {{ $data->name }}

                                            @if ($data->id == auth()->user()->id)
                                                <span style="color: green; font-weight: bold;">(You)</span>
                                            @endif

                                        </h5>  <br>
                                        <span> Email: {{ $data->email }}</span><br>
                                        <span> Phone: {{ $data->phone }}</span><br>
                                        <span> Student ID: {{ $data->student_id_number }}</span><br>
                                        <span> Batch No.: {{ collect($user->generateBatchNumbers())->get($data->batch_number) }}</span><br>
                                        <span> Department: {{ collect($user->getDepartments())->get($data->department_id) }}</span><br>
                                        <span> Passing Year: {{ collect($user->generatePassingYears())->get($data->passing_year) }}</span><br>
                                        <span> Address: {{ $data->address }}</span><br>
                                        <span> Registered: {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y H:i:s a') }}</span><br>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
