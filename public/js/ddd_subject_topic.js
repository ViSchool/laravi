 $(document).ready(function() {

    $('select[name="subject_id"]').on('change', function(){
        var subjectId = $(this).val();
        if(subjectId) {
            $.ajax({
                url: '/topics/get/'+subjectId,
                type:"GET",
                dataType:"json",

                success:function(data) {

                    $('select[name="topic_id"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="topic_id"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="topic_id"]').empty();
        }

    });

});