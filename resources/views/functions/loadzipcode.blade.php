<script type="text/javascript">
    function loadzipcode() {

    zipcode = $('#zipcode').val();

    if ($('#zipcode').val().length > 8) {

        $('#loading').css('display', 'block');
        $('#district').css('display', 'none');
        $("#district").val("");
        const url = $('#businessForm').attr("data-district-url");

        console.log(zipcode);
        $.ajax({
            url: url,
            data: {
                'zipcode': zipcode,
            },
            success: function(data) {
                $('#loading').css('display', 'none');
                $('#district').css('display', 'block');
                $("#district").html(data);
            }
        })
    }
    };

</script>