@if (Session::has('success'))
    <script>
        console.log('success');
        var options =  {
            content: "{{ Session::get('success') }}",
            style: "snackbar",
            timeout: 5000
        }

        $.snackbar(options);
    </script>
@endif