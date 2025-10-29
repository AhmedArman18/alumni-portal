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
                    <!-- Box Event -->
                    @forelse ($events as $event)
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" src="{{ $event->created_by_avatar }}" alt="User Image">
                                    <span class="username"><a href="#">{{ $event->created_by }}</a></span>
                                    <span class="description">Shared publicly - {{ $event->create_time }}</span>
                                    </span>
                                    <span class="description">Time - {{ $event->time }}</span>
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
                                <strong>{{ $event->title }}</strong>

                                <p>{{ $event->description }} <a href="{{ route('public.events.show', $event->id) }}">Read More</a></p>

                                <!-- Attachment -->
                                {{-- <div class="attachment-block clearfix">
                                    <img class="attachment-img" src="{{ asset('img/photo2.png') }}" alt="Attachment Image">

                                    <div class="attachment-pushed">
                                        <h4 class="attachment-heading"><a href="https://www.lipsum.com/">Lorem ipsum text
                                                generator</a></h4>

                                        <div class="attachment-text">
                                            Description about the attachment can be placed here.
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry... <a
                                                href="#">more</a>
                                        </div>
                                        <!-- /.attachment-text -->
                                    </div>
                                    <!-- /.attachment-pushed -->
                                </div> --}}
                                <!-- /.attachment-block -->

                                <!-- Social sharing buttons -->
                                {{-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share text-primary"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm"><i class="far fas fa-heart text-danger"></i>
                                </button>
                                <span class="float-right text-muted">45 likes - 2 comments</span> --}}
                            </div>
                            <!-- /.card-body -->
                            {{-- <div class="card-footer card-comments">
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="{{ asset('img/user1-128x128.jpg') }}"
                                        alt="User Image">

                                    <div class="comment-text">
                                        <span class="username">
                                            Maria Gonzales
                                            <span class="text-muted float-right">8:03 PM Today</span>
                                        </span><!-- /.username -->
                                        It is a long established fact that a reader will be distracted
                                        by the readable content of a page when looking at its layout.
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                <!-- /.card-comment -->
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="{{ asset('img/user1-128x128.jpg') }}"
                                        alt="User Image">

                                    <div class="comment-text">
                                        <span class="username">
                                            Nora Havisham
                                            <span class="text-muted float-right">8:03 PM Today</span>
                                        </span><!-- /.username -->
                                        The point of using Lorem Ipsum is that it hrs a morer-less
                                        normal distribution of letters, as opposed to using
                                        'Content here, content here', making it look like readable English.
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                <!-- /.card-comment -->
                            </div> --}}
                            <!-- /.card-footer -->
                            {{-- <div class="card-footer">
                                <form action="#" method="post">
                                    <img class="img-fluid img-circle img-sm" src="{{ asset('img/user1-128x128.jpg') }}"
                                        alt="Alt Text">
                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                    <div class="img-push">
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Press enter to post comment">
                                    </div>
                                </form>
                            </div> --}}
                            <!-- /.card-footer -->
                        </div>
                    @empty
                        <p>No Events</p>
                    @endforelse
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
