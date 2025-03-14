@if (session()->has('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.success("{{ session('success') }}", "Successfully!", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000
            });
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.error("{{ session('error') }}", "Error!", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000
            });
        });
    </script>
@endif
