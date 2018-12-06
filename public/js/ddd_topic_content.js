 $(document).ready(function() {

    $('select[name="topic_id_dif"]').on('change', function(){
        var topicId = $(this).val();
        if(topicId) {
            $.ajax({
                url: '/contents/get/'+topicId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="content_id_dif"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="content_id_dif"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="content_id_dif"]').empty();
        }

    });

});