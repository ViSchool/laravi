 $(document).ready(function() {

    $('select[name="tool_id"]').on('change', function(){
        var toolId = $(this).val();
        if(toolId) {
            $.ajax({
                url: '/tools/get/'+toolId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {
                        
                        var text = $('#examplelink').text();
                        var textToAdd = "z.B.: " + data;
                        $('#examplelink').text(text.replace(text, textToAdd));
                },
                complete: function() {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('input[name="content_link"]').empty();
        }

    });

});