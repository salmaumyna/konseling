<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ URL::asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>

<script src="{{ URL::asset('assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ URL::asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ URL::asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ URL::asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ URL::asset('assets/js/misc.js') }}"></script>
<script src="{{ URL::asset('assets/js/settings.js') }}"></script>
<script src="{{ URL::asset('assets/js/todolist.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.cookie.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ URL::asset('assets/js/dashboard.js') }}"></script>

<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<script src="{{ URL::asset('assets/js/file-upload.js') }}"></script>
<script src="{{ URL::asset('assets/js/typeahead.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>

<!-- Sweetalert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- End custom js for this page -->

<script>
    $('body').on('click', '.btn-delete,.btn-action', function(e) {
        e.preventDefault();
        const title = $(this).data('confirm-title') || "Anda yakin?";
        const text = $(this).data('confirm-text') || "Anda yakin menghapus data ini?";
        const icon = $(this).data('confirm-icon') || "warning";
        const method = $(this).data('action-method') || "delete";
        const action = $(this).data('action');

        if (!action) {
            return;
        }
        const methods = {
            "delete": `@method('delete')`,
            "put": `@method('put')`,
            "patch": `@method('patch')`,
        }

        swal({
                title,
                text,
                icon,
                buttons: [
                    "Batalkan",
                    "Ya, Lakukan"
                ]
            })
            .then(function(confirm) {
                if (confirm) {
                    const form = $(`<form action="${action}" method="POST">
                    @csrf
                    ${methods[method]}
                </form>`);
                    $('body').append(form);
                    form.submit();
                }
            });
    });
</script>