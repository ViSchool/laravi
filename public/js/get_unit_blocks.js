 $(document).ready(function() {

    $('select[name="unit_id"]').on('change', function(){
        var unitId = $(this).val();
        if(unitId) {
            $.ajax({
                url: '/blocks/get/' + unitId,
                type: "GET",
                dataType: "json",

                success: function (data) {
                    console.log(data);
                
                    $.each(data, function (title, id) {
                        //create label with looped id 
                        var $block_label = $("label").attr({
                            for: "interaction_id",
                            class: "col-form-label"
                        });
                        //add text "title" to label with looped id
                        $('label[id="interaction_explain"]').after()
                    });
                    //create select with looped_id 
                    //add options 
                },
                complete: function () {
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('label[id="block_label"]').empty();
        }
    });

});