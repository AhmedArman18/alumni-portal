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
                    @forelse ($donations as $donation)
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" src="{{ $donation->created_by_avatar }}" alt="User Image">
                                    <span class="username"><a href="#">{{ $donation->created_by }}</a></span>
                                    <span class="description">Shared publicly - {{ $donation->create_time }}</span>
                                </div>
                                <!-- /.user-block -->
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" title="Mark as read">
                                        <i class="far fa-circle"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- post text -->
                                <strong>{{ $donation->title }}</strong>
                                <p>{{ $donation->description }} <a href="{{ route('public.donations.show', $donation->id) }}">Read More</a></p>
                                <p><strong>Bkash/Nagad:</strong> {{ $donation->contact_number }}</p>
                                <p><strong>Goal:</strong> {{ $donation->amount_formatted }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @empty
                        <p>No Donations</p>
                    @endforelse
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="d-flex justify-content-center">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
@endsection