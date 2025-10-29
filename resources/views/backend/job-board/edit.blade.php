@extends('skeleton.admin.app')

@section('title', 'Job Board | Edit')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Job Board Edit</h3>
                    <div class="card-body">
                        @if (auth()->user()->role->name == "Admin")
                            <form action="{{ url('/admin/job-board', $jobBoard->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input class="form-control" type="text" value="{{ $jobBoard->company_name }}" name="company_name" id="">
                                    @error('company_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input class="form-control" value="{{ $jobBoard->title }}" type="text" name="title" id="">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="">{{ trim($jobBoard->description) }}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Vacancy</label>
                                    <input class="form-control" value="{{ $jobBoard->vacancy }}" rows="3" name="vacancy" id=""> </input>
                                    @error('vacancy')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Experience Requirements</label>
                                    <input class="form-control" value="{{ $jobBoard->experience_requirements }}" rows="3" name="experience_requirements" id=""> </input>
                                    @error('experience_requirements')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Education Requirements</label>
                                    <input class="form-control" value="{{ $jobBoard->education_requirements }}" rows="3" name="education_requirements" id=""> </input>
                                    @error('education_requirements')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Company Information</label>
                                    <textarea class="form-control" rows="3" name="company_information" id="">{{ $jobBoard->company_information }}</textarea>
                                    @error('company_information')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="">Attachment(Image only)</label>--}}
{{--                                    <input class="form-control" type="file" name="image" id="">--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="">Job Type</label>
                                    <select class="form-control" name="job_type">
                                        <option value="">---Select---</option>
                                        <option {{ $jobBoard->job_type == 'intern' ? 'selected' : '' }} value="intern">Intern</option>
                                        <option {{ $jobBoard->job_type == 'part-time' ? 'selected' : '' }} value="part-time">Part Time</option>
                                        <option {{ $jobBoard->job_type == 'fulltime' ? 'selected' : '' }} value="fulltime">Full Time</option>
                                    </select>
                                    @error('job_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Salary</label>
                                    <input value="{{ $jobBoard->salary }}" class="form-control" type="text" name="salary" id="">
                                    @error('salary')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <input value="{{ $jobBoard->location }}" class="form-control" type="text" name="location" id="">
                                    @error('location')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Application Deadline</label>
                                    <input value="{{ $jobBoard->application_deadline }}" class="form-control" type="date" name="application_deadline" id="">
                                    @error('application_deadline')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">External Job Link (If any)</label>
                                    <input class="form-control" placeholder="Example: https://example.com/job/12" type="text" name="external_job_link" id="" value="{{ $jobBoard->external_job_link }}">
                                    @error('external_job_link')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        @else
                            <form action="{{ route('job-board.update', $jobBoard->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input class="form-control" type="text" value="{{ $jobBoard->company_name }}" name="company_name" id="">
                                </div>
                                @error('company_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input class="form-control" value="{{ $jobBoard->title }}" type="text" name="title" id="">
                                </div>
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="">{{ trim($jobBoard->description) }}</textarea>
                                </div>
                                @error('description')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Vacancy</label>
                                    <input class="form-control" value="{{ $jobBoard->vacancy }}" rows="3" name="vacancy" id=""> </input>
                                </div>
                                @error('vacancy')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Experience Requirements</label>
                                    <input class="form-control" value="{{ $jobBoard->experience_requirements }}" rows="3" name="experience_requirements" id=""> </input>
                                </div>
                                @error('experience_requirements')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Education Requirements</label>
                                    <input class="form-control" value="{{ $jobBoard->education_requirements }}" rows="3" name="education_requirements" id=""> </input>
                                </div>
                                @error('education_requirements')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="">Company Information</label>
                                    <textarea class="form-control" rows="3" name="company_information" id="">{{ $jobBoard->company_information }}</textarea>
                                </div>
                                @error('company_information')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
{{--                                <div class="form-group">--}}
{{--                                    <label for="">Attachment(Image only)</label>--}}
{{--                                    <input class="form-control" type="file" name="image" id="">--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="">Job Type</label>
                                    <select class="form-control" name="job_type">
                                        <option value="">---Select---</option>
                                        <option {{ $jobBoard->job_type == 'intern' ? 'selected' : '' }} value="intern">Intern</option>
                                        <option {{ $jobBoard->job_type == 'part-time' ? 'selected' : '' }} value="part-time">Part Time</option>
                                        <option {{ $jobBoard->job_type == 'fulltime' ? 'selected' : '' }} value="fulltime">Full Time</option>
                                    </select>
                                    @error('job_type')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Salary</label>
                                    <input value="{{ $jobBoard->salary }}" class="form-control" type="text" name="salary" id="">
                                    @error('salary')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <input value="{{ $jobBoard->location }}" class="form-control" type="text" name="location" id="">
                                    @error('location')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Application Deadline</label>
                                    <input value="{{ $jobBoard->application_deadline }}" class="form-control" type="date" name="application_deadline" id="">
                                    @error('application_deadline')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">External Job Link (If any)</label>
                                    <input class="form-control" placeholder="Example: https://example.com/job/12" type="text" name="external_job_link" id="" value="{{ $jobBoard->external_job_link }}">
                                    @error('external_job_link')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        $(document).ready(function() {
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
