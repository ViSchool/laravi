 $(document).ready(function() {

    $('select[name="subject"]').on('change', function(){
        var subjectId = $(this).val();
        if(subjectId) {
            $.ajax({
                url: '/topics/get/'+subjectId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="topic"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="topic"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="topic"]').empty();
        }

    });

});