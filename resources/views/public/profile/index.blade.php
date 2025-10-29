@extends('skeleton.public.app')
@section('title', 'Profile')
@push('style')
@endpush
@section('body')
    <div class="content">
        <div class="container">
            <div class="container-fluid">
                <!-- user profile with cover picture -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white"
                        style="background: url('{{ asset('img/photo2.png') }}') center center;">
                        <h3 class="widget-user-username text-right bg mb-2">
                            <span class="bg-gradient-danger px-1">{{ auth()->user()->name }}</span>
                        </h3>
                        {{-- <h5 class="widget-user-desc text-right">
                            <span class="bg-gradient-success px-1">Junior Software Engineer</span>
                        </h5> --}}
                        {{-- <h5 class="widget-user-desc text-right">
                            <span class="bg-gradient-success px-1">{{ ucfirst(auth()->user()->type) }}</span>
                        </h5> --}}
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" style="height:90px" src="{{ getProfilePicture() }}" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        {{-- <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">Followers</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">Following</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">Friends</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            {{-- <div class="card-body box-profile"> --}}
                            {{-- <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('img/user1-128x128.jpg') }}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">Nina Mcintire</h3>

                                <p class="text-muted text-center">Software Engineer</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li>
                                </ul> --}}

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                            {{-- </div> --}}
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    University of information technology and sciences
                                </p>

                                <hr>

                                <strong><i class="fa-solid fa-graduation-cap"></i> Department</strong>

                                <p class="text-muted">
                                    {{ getDepartments()[auth()->user()->department_id] ?? '' }}
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                <p class="text-muted">{{ auth()->user()->address }}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    {{-- <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab">Activity</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                    </li> --}}
                                    <li class="nav-item"><a class="nav-link active" href="#settings"
                                            data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    {{-- <div class="active tab-pane" id="activity">
                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('img/user1-128x128.jpg') }}" alt="user image">
                                                <span class="username">
                                                    <a href="#">Jonathan Burke Jr.</a>
                                                    <a href="#" class="float-right btn-tool"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Shared publicly - 7:30 PM today</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.
                                            </p>

                                            <p>
                                                <a href="#" class="link-black text-sm mr-2"><i
                                                        class="fas fa-share mr-1"></i> Share</a>
                                                <a href="#" class="link-black text-sm"><i
                                                        class="far fa-thumbs-up mr-1"></i> Like</a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                </span>
                                            </p>

                                            <input class="form-control form-control-sm" type="text"
                                                placeholder="Type a comment">
                                        </div>
                                        <!-- /.post -->

                                        <!-- Post -->
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('img/user1-128x128.jpg') }}" alt="User Image">
                                                <span class="username">
                                                    <a href="#">Sarah Ross</a>
                                                    <a href="#" class="float-right btn-tool"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Sent you a message - 3 days ago</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <p>
                                                Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.
                                            </p>

                                            <form class="form-horizontal">
                                                <div class="input-group input-group-sm mb-0">
                                                    <input class="form-control form-control-sm" placeholder="Response">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.post -->

                                        <!-- Post -->
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('img/user1-128x128.jpg') }}" alt="User Image">
                                                <span class="username">
                                                    <a href="#">Adam Jones</a>
                                                    <a href="#" class="float-right btn-tool"><i
                                                            class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Posted 5 photos - 5 days ago</span>
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="row mb-3">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid" src="{{ asset('img/photo2.png') }}"
                                                        alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3"
                                                                src="{{ asset('img/photo1.png') }}" alt="Photo">
                                                            <img class="img-fluid" src="{{ asset('img/photo3.jpg') }}"
                                                                alt="Photo">
                                                        </div>
                                                        <!-- /.col -->
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3"
                                                                src="{{ asset('img/photo4.jpg') }}" alt="Photo">
                                                            <img class="img-fluid" src="{{ asset('img/photo2.png') }}"
                                                                alt="Photo">
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->

                                            <p>
                                                <a href="#" class="link-black text-sm mr-2"><i
                                                        class="fas fa-share mr-1"></i> Share</a>
                                                <a href="#" class="link-black text-sm"><i
                                                        class="far fa-thumbs-up mr-1"></i> Like</a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                </span>
                                            </p>

                                            <input class="form-control form-control-sm" type="text"
                                                placeholder="Type a comment">
                                        </div>
                                        <!-- /.post -->
                                    </div> --}}
                                    <!-- /.tab-pane -->
                                    {{-- <div class="tab-pane" id="timeline">
                                        <!-- The timeline --> --}}
                                    {{-- <div class="timeline timeline-inverse">
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-danger">
                                                    10 Feb. 2014
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-envelope bg-primary"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent
                                                        you an email</h3>

                                                    <div class="timeline-body">
                                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                        quora plaxo ideeli hulu weebly balihoo...
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-user bg-info"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                                    <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                        accepted your friend request
                                                    </h3>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-comments bg-warning"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                                    <h3 class="timeline-header"><a href="#">Jay White</a> commented
                                                        on your post</h3>

                                                    <div class="timeline-body">
                                                        Take me to your leader!
                                                        Switzerland is small and neutral!
                                                        We are more like Germany, ambitious and misunderstood!
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                            comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                            <!-- timeline time label -->
                                            <div class="time-label">
                                                <span class="bg-success">
                                                    3 Jan. 2014
                                                </span>
                                            </div>
                                            <!-- /.timeline-label -->
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-camera bg-purple"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded
                                                        new photos</h3>
                                                    {{-- use 150 * 150 photos for better view --}}
                                    {{-- <div class="timeline-body">
                                                        <img src="{{ asset('img/user2-160x160.jpg') }}" alt="...">
                                                        <img src="{{ asset('img/user2-160x160.jpg') }}" alt="...">
                                                        <img src="{{ asset('img/user2-160x160.jpg') }}" alt="...">
                                                        <img src="{{ asset('img/user2-160x160.jpg') }}" alt="...">
                                                    </div>
                                                </div>
                                            </div> --}}
                                    {{-- <!-- END timeline item -->
                                            <div>
                                                <i class="far fa-clock bg-gray"></i>
                                            </div>
                                    </div> --}}
                                    <!-- /.tab-pane -->

                                    <div class="active tab-pane" id="settings">
                                        @includeIf('skeleton.admin.partials.alerts')
                                        <form class="form-horizontal" method="POST"
                                        action="{{ url('profile/'.auth()->user()->id) }}"
                                        enctype="multipart/form-data"
                                        >
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-form-label">Name</label> <span class="text-danger">*</span>
                                                        <input type="text" class="form-control"
                                                        name="name"
                                                            value="{{ auth()->user()->name ?? '' }}" placeholder="Name">
                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="col-form-label">Email</label><span class="text-danger">*</span>
                                                        <input type="email" class="form-control"
                                                        name="email"
                                                            value="{{ auth()->user()->email ?? '' }}" placeholder="Email">
                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="batch_number">Batch No.</label>

                                                        <select style="width: 100%;" class="form-control"
                                                            name="batch_number" id="batch_number">
                                                            <option value="0">--Select--</option>
                                                            @foreach (generateBatchNumbers() as $key => $batchNumber)
                                                                <option @if (auth()->user()->batch_number == $key) selected @endif
                                                                    value="{{ $key }}">{{ $batchNumber }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('batch_number')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="passing_year">Passing Year.</label>

                                                        <select style="width: 100%;" class="form-control"
                                                            name="passing_year" id="passing_year">
                                                            <option value="0">--Select--</option>
                                                            @foreach (generatePassingYears() as $key => $passingYear)
                                                                <option @if (auth()->user()->passing_year == $key) selected @endif
                                                                    value="{{ $key }}">{{ $passingYear }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="department_id">Department</label>

                                                        <select style="width: 100%;" class="form-control"
                                                            name="department_id" id="department_id">
                                                            <option value="0">--Select--</option>
                                                            @foreach (getDepartments() as $key => $department)
                                                                <option @if (auth()->user()->department_id == $key) selected @endif
                                                                    value="{{ $key }}">{{ $department }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="student_id_number">Student ID</label>

                                                        <input style="width: 100%;" class="form-control" type="text"
                                                            name="student_id_number" id="student_id_number"
                                                            value="{{ auth()->user()->student_id_number ?? '' }}"
                                                            placeholder="Eg. 1791015123">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>

                                                        <input style="width: 100%;" class="form-control" type="text"
                                                            value="{{ auth()->user()->phone ?? '' }}" name="phone"
                                                            id="phone" placeholder="Eg. 01711111111">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>

                                                        <input style="width: 100%;" class="form-control" type="text"
                                                            name="address" id="address"
                                                            value="{{  auth()->user()->address ?? '' }}"
                                                            placeholder="Eg. Shewrapara, Mirpur, Dhaka">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="profile_pic">Profile Picture</label>
                                                        <input style="width: 100%;" class="form-control" type="file" name="profile_pic" id="profile_pic">
                                                    </div>

                                                    @error('profile_pic')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <p>
                                                <a class="btn btn-sm btn-secondary" data-toggle="collapse" href="#collapsePasswordChange" role="button" aria-expanded="false" aria-controls="collapsePasswordChange">
                                                    Change Password
                                                </a>
                                            </p>
                                            <div class="collapse @error('password') show @enderror" id="collapsePasswordChange">
                                              <div class="card card-body">
                                                <p class="text-muted">Leave blank if you don't want to change password</p>
                                                 <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input style="width: 100%;" class="form-control" type="password" name="password" id="password"
                                                            autocomplete="off"
                                                            readonly
                                                            onfocus="this.removeAttribute('readonly');"
                                                            placeholder="Password">
                                                            @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                     </div>
                                                     <div class="col-md-6">
                                                        <label for="password_confirmation">Confirm Password</label>
                                                        <input style="width: 100%;" class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                                                        autocomplete="off"
                                                        readonly
                                                        onfocus="this.removeAttribute('readonly');"
                                                        placeholder="Confirm Password">
                                                        @error('password_confirmation')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                     </div>
                                                 </div>
                                              </div>
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
