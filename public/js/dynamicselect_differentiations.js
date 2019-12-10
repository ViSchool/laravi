$(document).ready(function () {
    var teacherId = {!! json_encode($teacher -> id)!!
};
$('select[name="differentiation_group"]').on('change', function () {

    var differentiation_group = $(this).val();
    if (differentiation_group) {
        $.ajax({
            url: '/differentiations/getgroupdiff/' + differentiation_group + '/' + teacherId,
            type: "GET",
            dataType: "json",
            success: function (data) {

                $('select[name="differentiations"]').empty();

                $.each(data, function (key, value) {

                    $('select[name="differentiations"]').append('<option value="' + key + '">' + value + '</option>');

                });
            },
        });
    } else {
        $('select[name="differentiations"]').empty();
    }

});
});