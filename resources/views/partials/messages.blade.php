@if(session()->has('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.success("{{ session('success') }}", "نجاح!", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000,
                rtl: true,
                closeHtml: '<button class="btn-close"></button>'
            });
        });
    </script>
@endif

@if(session()->has('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.error("{{ session('error') }}", "خطأ!", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000,
                rtl: true,
                closeHtml: '<button class="btn-close"></button>'
            });
        });
    </script>
@endif

@if(session()->has('warning'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.warning("{{ session('warning') }}", "تنبيه!", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000,
                rtl: true,
                closeHtml: '<button class="btn-close"></button>'
            });
        });
    </script>
@endif

@if(session()->has('info'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toastr.info("{{ session('info') }}", "معلومة!", {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right",
                timeOut: 3000,
                rtl: true,
                closeHtml: '<button class="btn-close"></button>'
            });
        });
    </script>
@endif

@if($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}", "خطأ!", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 3000,
                    rtl: true,
                    closeHtml: '<button class="btn-close"></button>'
                });
            @endforeach
        });
    </script>
@endif