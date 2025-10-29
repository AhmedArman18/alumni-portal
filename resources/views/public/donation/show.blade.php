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
                <div class="col-md-12 mt-1">
                    <!-- Box Donation -->
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <img class="img-circle" src="{{ $donation->created_by_avatar }}" alt="User Image">
                                <span class="username"><a href="#">{{ $donation->created_by }}</a></span>
                                <span class="description">Shared publicly - {{ $donation->create_time }}</span>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- post text -->
                            <strong>{{ $donation->title }}</strong>
                            <p>{{ $donation->description }}</p>
                            <p><strong>Bkash/Nagad Number:</strong> {{ $donation->contact_number }}</p>
                            <p><strong>Goal:</strong> {{ $donation->amount_formatted }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <a href="{{ route('public.donations.index') }}" class="btn btn-secondary">Back to Donations</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection