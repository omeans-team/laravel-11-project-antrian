<div>
    <h2>Nomor Antrian</h2>
    <p id="jumlah-antrian"></p>
</div>

<script>
    $.ajax({
        type: 'GET',
        url: '{{ route('get_antrian') }}',
        success: function(data) {
            $('#jumlah-antrian').html('Jumlah Antrian: ' + data);
        }
    });
</script>
