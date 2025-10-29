@extends('skeleton.public.app')
@push('style')
    <style>
        .status-box {
            font-size: 1.3rem;
            height: 60px;
            border-radius: 20px;
        }
    </style>
@endpush
@section('body')
    <div class="content">
        <div class="container">
            <div id="home-main-content"></div>
        </div>
    </div>

    <script src="{{ mix('js/home/index.js') }}"></script>
@endsection
