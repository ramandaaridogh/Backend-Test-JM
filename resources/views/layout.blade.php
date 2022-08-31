<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/favicon.ico"/>

    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container-scroller">
    <!-- partial:{{ url('/') }}/partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{ url('/') }}/index.html"><img
                    src="{{ url('/') }}/assets/images/logo.svg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}/index.html"><img
                    src="{{ url('/') }}/assets/images/logo-mini.svg" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <div class="nav-profile-img">
                            <img src="{{ url('/') }}/assets/images/faces/face1.jpg" alt="image">
                            <span class="availability-status online"></span>
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">{{auth()->user()->name}}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <form class="pt-3" id="logout" method="POST" action="">
                            @method('POST')
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="mdi mdi-logout me-2 text-primary"></i>
                                Signout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:{{ url('/') }}/partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                            <img src="{{ url('/') }}/assets/images/faces/face1.jpg" alt="profile">
                            <span class="login-status online"></span>
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                            <span class="font-weight-bold mb-2">{{auth()->user()->name}}</span>
                            <span class="text-secondary text-small">Project Manager</span>
                        </div>
                        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="menu-title">Dashboard</span>
                        <i class="mdi mdi-border-all menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('units') }}">
                        <span class="menu-title">Master Unit</span>
                        <i class="mdi mdi-border-all menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee') }}">
                        <span class="menu-title">Employee</span>
                        <i class="mdi mdi-account-group menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users') }}">
                        <span class="menu-title">User</span>
                        <i class="mdi mdi-account-group menu-icon"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        @yield('content')
        <!-- content-wrapper ends -->
        <!-- partial:{{ url('/') }}/partials/_footer.html -->
        <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
                <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
                <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> Free <a
                        href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ url('/') }}/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ url('/') }}/assets/js/off-canvas.js"></script>
<script src="{{ url('/') }}/assets/js/hoverable-collapse.js"></script>
<script src="{{ url('/') }}/assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    window.CSRF_TOKEN = "{{ csrf_token() }}";

    function processData(url, type = 'GET', extra) {
        return new Promise((resolve, reject) =>
            $.ajax({
                url: url,
                headers: {"X-CSRF-TOKEN": window.CSRF_TOKEN},
                type: type,
                cache: true,
                success: data => {
                    if (data) {
                        resolve(data)
                    } else {
                        reject({error: "data kosong"})
                    }
                },
                error: error => {
                    const errors = $.parseJSON(error.responseText)
                    reject(errors)
                },
                ...extra
            })
        )
    }

    $('#logout').submit(function (e) {
        e.preventDefault();
        let data = $('#logout').serialize();
        $.ajax({
            url: "{{ route('api.logout') }}",
            headers: {
                'X-CSRF-TOKEN': window.CSRF_TOKEN
            },
            type: "POST",
            data: data,
            success: function (res) {
                if (res.success) {
                    window.location.href = "{{ route('dashboard') }}";
                } else {
                    alert(res.message);
                }
            },
            error: function (res) {
                alert(res.message);
            }
        });
    });

    function alert_notif(title = null, pesan = null, fn = null, xclass = "danger") {
        title = title == null ? 'Sukses' : title;
        pesan = pesan == null ? 'Proses selesai!' : pesan;
        $('#popup_loading').hide();
        $("body").append(
            '<div id="x_alert">'
            + '<div class="x_alert_box">'
            + '<div class="x_alert_header x_color_' + xclass + '">' + title + '</div>'
            + '<div class="x_alert_body">' + pesan + '</div>'
            + '<div class="x_alert_footer">'
            + '<div class="x_alert_btn_ok x_btn x_color_cancel">OK</div>'
            + '</div>'
            + '</div>'
            + '</div>');
        $(".x_alert_btn_ok").click(function () {
            if (fn != null) fn();
            $("#x_alert").remove();
        });
    }
</script>
@yield('script')

<script>

    $('[data-dismiss="modal"]').on('click', function (e) {
        $('.modal').modal('hide')
    })

    $('.select2').select2({
        dropdownParent: $(".modal")
    });


</script>
</body>
</html>
