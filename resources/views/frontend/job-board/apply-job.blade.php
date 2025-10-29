@extends('skeleton.admin.app')

@section('title', 'Job Application Form')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Job Application Form</h3>
                    <div class="card-body">
                        <form action="{{ url('/job/apply') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <input type="hidden" name="job_board_id" value="{{ $jobPostId }}">
                            <input type="hidden" name="applied_by" value="{{ $userId }}">

                            <div class="form-group">
                                <label for="">Resume <span style="color: red;">*</span></label>
                                <input  class="form-control" type="file"
                                       name="resume_path" id="">
                                @error('resume_path')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Linkedin Url</label>
                                <input  class="form-control"  type="text" name="linkedin_url"
                                       id="">
                            </div>
                            <div class="form-group">
                                <label for="">Github Url</label>
                                <input class="form-control" type="text" name="github_url"
                                       id="">
                            </div>
                            <div class="form-group">
                                <label for="">Portfolio Url</label>
                                <input class="form-control" name="portfolio_url" id="">
                            </div>

                            <button class="btn btn-primary" type="submit">APPLY</button>
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
