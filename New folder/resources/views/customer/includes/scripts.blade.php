<!-- JavaScript files -->
<script src="{{ asset('customer/js/jquery.min.js') }}"></script>
<script src="{{ asset('customer/js/popper.min.js') }}"></script>
<script src="{{ asset('customer/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('customer/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('customer/js/plugin.js') }}"></script>
<script src="{{ asset('customer/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('admin/plugins/sweetalert/sweetalert.min.js')}}"></script>

@stack('js')
<!-- Sidebar control -->
<script>
    function confirmAction(msg,id) {
        event.preventDefault();
        swal({
            title:  'Permanently Delete?',
            // text: "You will not be able to recover this imaginary file!",
            // type: "warning   ",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                document.getElementById(id).submit();
            } else {
                swal("Cancelled", '', "error");
            }
        });
    }


    function confirmActionLogout(msg,id) {
        event.preventDefault();
        swal({
            title:  'Logout?',
            // text: "You will not be able to recover this imaginary file!",
            // type: "warning   ",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Logout",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                document.getElementById(id).submit();
            } else {
                swal("Cancelled", '', "error");
            }
        });
    }
    $(document).ready(function () {
        // Success Message
        @if(session('successfully'))
        toastr.success("{{ session('successfully') }}", 'Success', {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
        });
        @endif

        // Error Message
        @if(session('failed'))
        toastr.error("{{ session('failed') }}", 'Error', {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
        });
        @endif
    });

    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

