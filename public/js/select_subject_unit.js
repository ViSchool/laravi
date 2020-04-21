 $(document).ready(function() {

    $('select[name="subject_id"]').on('change', function(){
        var subjectId = $(this).val();
        if(subjectId) {
            $.ajax({
                url: '/units/get/' + subjectId,
                type: "GET",
                dataType: "json",

                success: function (data) {

                    $('select[id="unit_id"]').empty();
                    $('select[name="unit_id"]').append('<option value="">Bitte Lerneinheit auswählen</option>');

                    $.each(data, function (key, value) {

                        $('select[name="unit_id"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[id="units"]').empty();
        }
    });

});