 $(document).ready(function() {
     $('#')   
    var contentId = param;
        console.log(contentID);
        if(contentId) {
            $("@include('teacher.teacher_components.chosenContentImage', ['id' =>" + contentID + "])").appendTo('#chosenContent');
        }
        else {
            $('#chosenContent').empty();
     }

 });