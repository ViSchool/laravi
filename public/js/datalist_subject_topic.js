 $(document).ready(function() {

    $('select[name="subject_id"]').on('change', function(){
        var subjectId = $(this).val();
        if(subjectId) {
            $.ajax({
                url: '/topics/get/'+subjectId,
                type:"GET",
                dataType:"json",

                success:function(data) {

                    $('datalist[id="topics"]').empty();

                    $.each(data, function(key, value){

                        $('datalist[id="topics"]').append('<option value="' + value + '"');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('datalist[id="topics"]').empty();
        }

    });

});