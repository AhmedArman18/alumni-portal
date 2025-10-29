@extends('skeleton.admin.app')

@if ($donation == null)
    @section('title', 'Create Donation')
@else
    @section('title', 'Update Donation')
@endif

@section('body')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $donation ? 'Update Donation' : 'Create Donation' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ $donation ? 'Update Donation' : 'Create Donation' }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.index') : route('alumni.donations.index') }}">
                                Donations
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            Please fill the form below
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST"
                              action="{{ $donation ? (auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.update', $donation->id) : route('alumni.donations.update', $donation->id)) : (auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.store') : route('alumni.donations.store')) }}">
                            @csrf
                            @if ($donation)
                                @method('PUT')
                            @endif
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" value="{{ $donation ? $donation->title : old('title') }}" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Enter Title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                              id="description" rows="3" placeholder="Enter Description">{{ $donation ? $donation->description : old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">Bkash/Nagad Number <span class="text-danger">*</span></label>
                                    <input name="contact_number" value="{{ $donation ? $donation->contact_number : old('contact_number') }}"
                                           type="text" class="form-control @error('contact_number') is-invalid @enderror"
                                           id="contact_number" placeholder="Enter Bkash/Nagad Number ">
                                    @error('contact_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount (Optional)</label>
                                    <input name="amount" value="{{ $donation ? $donation->amount : old('amount') }}"
                                           type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror"
                                           id="amount" placeholder="Enter Donation Goal Amount">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2-input @error('status') is-invalid @enderror"
                                            id="status">
                                        <option value="">Select Status</option>
                                        @foreach (\App\Models\Donation::STATUSES as $key => $label)
                                            <option value="{{ $key }}"
                                                    @if ($donation ? $key == $donation->status : $key == old('status')) selected @endif>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit"
                                        class="btn {{ $donation ? 'btn-success' : 'btn-primary' }}"><i class="fas fa-save"></i>
                                    {{ $donation ? ' Update' : ' Create' }}</button>
                                <a href="{{ auth()->user()->role->id == \App\Models\Role::ROLE_ADMIN ? route('donations.index') : route('alumni.donations.index') }}"
                                   class="btn btn-danger"><i class="fas fa-times"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection