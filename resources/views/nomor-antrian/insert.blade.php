<div>
    <h2>Insert Antrian</h2>
    <form id="insert-antrian-form">
        <!-- no form fields needed, we'll use AJAX to submit the request -->
    </form>

    <div id="insert-response"></div>

    <script>
        $.ajax({
            type: 'POST',
            url: '{{ route('insert_antrian') }}',
            data: {},
            success: function(data) {
                $('#insert-response').html(data);
            }
        });
    </script>
</div>
