<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') &nbsp; {{ config('app.name', 'UITS Alumni Portal') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte/adminlte.min.css') }}">
    @stack('style')
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Navbar -->
    @include('skeleton.public.includes.navbar')
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        @yield('body')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('skeleton.common.footer')
</div>
<!-- ./wrapper -->

<a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
</a>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte/adminlte.min.js') }}"></script>
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

        setInterval(fetchMessageNotification, 2000);

        function fetchMessageNotification() {
            $.ajax({
                url: "{{ url('/api/v1/chat/message-count') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data) {
                        let messageCount = data.data;
                        $('#chat-notification').text("("+messageCount+")");

                    }
                }
            });
        }


        fetchMessageNotification();
    });
</script>


</body>

</html>
