@if (Session::has('success'))
    <script>
        // Show notification from Session('success') on page load.
        $(function() {
            var options =  {
                content: "{{ Session::get('success') }}",
                style: "snackbar",
                timeout: 500000
            }

            $.snackbar(options);
        });
    </script>
@endif