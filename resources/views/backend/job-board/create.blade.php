@extends('skeleton.admin.app')

@section('title', 'Job Board | Create')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-3">
                    <h3 class="card-header">Job Board Create</h3>
                    <div class="card-body">
                        @if (auth()->user()->role->name == "Admin")
                            <form action="{{ url('/admin/job-board') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="">Company Name</label><span class="text-danger">*</span>
                                    <input class="form-control" type="text" placeholder="Write company name" value="{{ old('company_name') }}" name="company_name" id="">
                                    @error('company_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label> <span class="text-danger">*</span>
                                    <input class="form-control" placeholder="Write Job title" type="text" value="{{ old('title') }}" name="title" id="">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description/Responsibility</label><span class="text-danger">*</span>
                                    <textarea class="form-control" rows="3" name="description" value="{{ old('description') }}"
                                              id="">Write job Description/Responsibility</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Vacancy</label>
                                    <input class="form-control" placeholder="Example: 200" rows="3" name="vacancy" id="" value="{{ old('vacancy') }}"
                                    > </input>
                                    @error('vacancy')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Experience Requirements</label>
                                    <input class="form-control" rows="3" placeholder="Example: 2 years" name="experience_requirements" value="{{ old('experience_requirements') }}"
                                           id=""> </input>
                                    @error('experience_requirements')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Education Requirements</label>
                                    <input class="form-control" rows="3" placeholder="Example: Bsc in CSE" name="education_requirements" value="{{ old('education_requirements') }}"
                                           id=""> </input>
                                    @error('education_requirements')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Company Information </label>
                                    <textarea class="form-control" rows="3" name="company_information" value="{{ old('company_information') }}"
                                              id=""> Write company information</textarea>
                                    @error('company_information')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="">Attachment(Image only)</label>--}}
{{--                                    <input class="form-control" type="file" name="image" id="">--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="">Job Type</label><span class="text-danger">*</span>
                                    <select class="form-control" name="job_type">
                                        <option value="">---Select---</option>
                                        <option value="intern" @if (old('job_type') == 'intern') selected @endif>Intern</option>
                                        <option value="part-time" @if (old('job_type') == 'part-time') selected @endif>Part Time</option>
                                        <option value="fulltime" @if (old('job_type') == 'fulltime') selected @endif>Full Time</option>
                                    </select>
                                    @error('job_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Salary</label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="Example: 50000" type="text" name="salary" id="" value="{{ old('salary') }}">
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Location</label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="House: 12, Road: 5, Mirpur 12, Dhaka" type="text" name="location" id="" value="{{ old('location') }}">
                                    @error('location')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Application Deadline</label><span class="text-danger">*</span>
                                    <input class="form-control" type="date" name="application_deadline" id="" value="{{ old('application_deadline') }}">
                                    @error('application_deadline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">External Job Link (If any)</label>
                                    <input class="form-control" placeholder="Example: https://example.com/job/12" type="text" name="external_job_link" id="" value="{{ old('external_job_link') }}">
                                    @error('external_job_link')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>

                        @else
                            <form action="{{ route('job-board.store') }}" method="POST"
                                  enctype="multipart/form-data">

                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="">Company Name</label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="Write company name" type="text" value="{{ old('company_name') }}" name="company_name" id="">
                                    @error('company_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="Write Job title" type="text" value="{{ old('title') }}" name="title" id="">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description/Responsibility</label><span class="text-danger">*</span>
                                    <textarea class="form-control" rows="3" name="description" value="{{ old('description') }}"
                                              id="">Write job Description/Responsibility</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Vacancy</label>
                                    <input class="form-control" placeholder="Example: 200" rows="3" name="vacancy" id="" value="{{ old('vacancy') }}" > </input>
                                    @error('vacancy')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Experience Requirements</label>
                                    <input class="form-control" placeholder="Example: 2 years" rows="3" name="experience_requirements" value="{{ old('experience_requirements') }}"
                                           id=""> </input>
                                    @error('experience_requirements')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Education Requirements</label>
                                    <input class="form-control" placeholder="Example: Bsc in CSE" rows="3" name="education_requirements" value="{{ old('education_requirements') }}"
                                           id=""> </input>
                                    @error('education_requirements')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Company Information</label>
                                    <textarea class="form-control" rows="3" name="company_information" value="{{ old('company_information') }}"
                                              id="">Write company information</textarea>
                                    @error('company_information')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="">Attachment(Image only)</label>--}}
{{--                                    <input class="form-control" type="file" name="image" id="">--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="">Job Type</label><span class="text-danger">*</span>
                                    <select class="form-control" name="job_type" value="{{ old('job_type') }}">
                                        <option value="">---Select---</option>
                                        <option value="intern">Intern</option>
                                        <option value="part-time">Part Time</option>
                                        <option value="fulltime">Full Time</option>
                                    </select>
                                    @error('job_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Salary</label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="Example: 50000" type="text" name="salary" id="" value="{{ old('salary') }}">
                                    @error('salary')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Location</label>
                                    <input class="form-control" placeholder="House: 12, Road: 5, Mirpur 12, Dhaka" type="text" name="location" id="" value="{{ old('location') }}">
                                    @error('location')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Application Deadline</label><span class="text-danger">*</span>
                                    <input class="form-control" type="date" name="application_deadline" id="" value="{{ old('application_deadline') }}">
                                    @error('application_deadline')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">External Job Link (If any)</label>
                                    <input class="form-control" placeholder="Example: https://example.com/job/12" type="text" name="external_job_link" id="" value="{{ old('external_job_link') }}">
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
