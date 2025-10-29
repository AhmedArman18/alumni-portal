<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | UITS Alumni Portal</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.min.css') }}">

    {{--    Toaster --}}
    <link rel="stylesheet" href="{{ asset('css/toaster.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('css/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte/adminlte.min.css') }}">

    {{-- selec2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    @include('skeleton.admin.includes.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('skeleton.admin.includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('body')
    </div>
    <!-- /.content-wrapper -->
    @includeIf('skeleton.admin.includes.footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('css/overlayScrollbars/js/OverlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte/adminlte.min.js') }}"></script>
{{-- Toaster--}}
<script src="{{ asset('js/toaster.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="../../dist/js/demo.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function () {
        $('.select2-input').select2();
    });
</script>
<script>
    flatpickr("input[type=date-time]", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        allowInput: true,
    });

    flatpickr("input[type=date]", {
        allowInput: true
    });
</script>
<script>
    //get user notifications
    $(document).ready(function () {
        fetchUnreadNotifications();

        //fetch notifications after every 10 seconds
        setInterval(fetchUnreadNotifications, 10000);

        function fetchUnreadNotifications() {
            $.ajax({
                url: "{{ url('/api/v1/notifications/unread') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.length) {
                        // console.log(data.length);
                        $('#notification-count').text(data.length);
                        $('#notification-list').html('');


                        // <span class="float-right text-muted text-sm">12 hours</span>

                        data.forEach(function (notification) {
                            const commentNotification = notification.type == "App\\Notifications\\NewCommentNotification";
                            const likeNotification = notification.type == "App\\Notifications\\NewLikeNotification";

                            if (commentNotification) {
                                $('#notification-list').append(
                                    `<a href="#" class="dropdown-item">
                                        <i class="fas fa-comment mr-2"></i> ${notification.data.commenter} commented on your post
                                    </a>
                                    <div class="dropdown-divider"></div>`);
                            }

                            if (likeNotification) {
                                const commentLikNotification = notification.data.commenter;
                                const postLikeNotification = notification.data.liker;

                                if (commentLikNotification) {
                                    $('#notification-list').append(
                                        `<a href="#" class="dropdown-item">
                                            <i class="fas fa-thumbs-up mr-2"></i> ${notification.data.liker} liked your comment
                                        </a>
                                        <div class="dropdown-divider"></div>`);
                                }
                                if (postLikeNotification) {
                                    $('#notification-list').append(
                                        `<a href="#" class="dropdown-item">
                                            <i class="fas fa-thumbs-up mr-2"></i> ${notification.data.liker} liked your post
                                        </a>
                                        <div class="dropdown-divider"></div>`);
                                }
                            }
                        });
                    }
                }
            });
        }

        // mark all notifications as read
        $('#markAllNotificationAsRead').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: "{{ url('/api/v1/notifications/mark-all-as-read') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.message) {
                        $('#notification-count').text(0);
                        $('#notification-list').html('');
                    }
                }
            });
        });
    });
</script>

@yield('script')
</body>
</html>
