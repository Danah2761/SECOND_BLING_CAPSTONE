<!-- Jquery Core Js -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Select Plugin Js -->
<script src="{{ asset('admin/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{ asset('admin/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('admin/plugins/node-waves/waves.js') }}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('admin/plugins/jquery-countto/jquery.countTo.js') }}"></script>

<!-- Morris Plugin Js -->
<script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/plugins/morrisjs/morris.js') }}"></script>

<!-- ChartJs -->
<script src="{{ asset('admin/plugins/chartjs/Chart.bundle.js') }}"></script>
<!-- Flot Charts Plugin Js -->
<script src="{{asset('admin/plugins/flot-charts/jquery.flot.js')}}"></script>
<script src="{{asset('admin/plugins/flot-charts/jquery.flot.resize.js')}}"></script>
<script src="{{asset('admin/plugins/flot-charts/jquery.flot.pie.js')}}"></script>
<script src="{{asset('admin/plugins/flot-charts/jquery.flot.categories.js')}}"></script>
<script src="{{asset('admin/plugins/flot-charts/jquery.flot.time.js')}}"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="{{asset('admin/plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>
<!-- Custom Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="{{asset('admin/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
{{--<script src="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>--}}
<script src="{{asset('admin/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('admin/js/pages/forms/basic-form-elements') }}"></script>
@stack('js2')
<script src="{{ asset('admin/js/admin.js') }}"></script>
<script src="{{asset('admin/js/pages/tables/jquery-datatable.js')}}"></script>

<script src="{{ asset('admin/js/pages/index.js') }}"></script>


<!-- Demo Js -->
<script src="{{ asset('admin/js/demo.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>
<script src="{{ asset('admin/js/pages/ui/notifications.js') }}"></script>
@stack('js')
<script>
    // Function to show success notification
    function showSuccessNotification(msg) {
        showNotification('bg-green', msg, 'top', 'center', 'animated fadeInDown', 'animated fadeOutUp');
    }

    function showErrorNotification(msg) {
        showNotification('bg-red', msg, 'top', 'center', 'animated fadeInDown', 'animated fadeOutUp');
    }

    @if(session('successfully'))
    showSuccessNotification('{{session('successfully')}}')
    @endif
    @if(session('failed'))
    showErrorNotification('{{session('failed')}}')
    @endif


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

    function confirmActionLock(msg,id) {
        event.preventDefault();
        swal({
            title:  'Are youe sure want to '+msg+' this seller?',
            // text: "You will not be able to recover this imaginary file!",
            // type: "warning   ",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Confirm",
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
</script>
