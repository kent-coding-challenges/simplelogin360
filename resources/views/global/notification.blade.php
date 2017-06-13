@if (Session::has('feedback_type') && Session::has('feedback_message'))
    <script>
        // Show notification from Session('success') on page load.
        $(function() {
            var options =  {
                content: "{{ Session::get('feedback_message') }}",
                style: "snackbar " + "{{ Session::get('feedback_type') }}",
                timeout: 5000
            }

            $.snackbar(options);
        });
    </script>
@endif