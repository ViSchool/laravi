$('#chooseContentModal').ready(function () {
   $('#chooseContentModalSave').click(function () {
      var radios = document.getElementsByName('chooseContent');
      for (var i = 0, length = radios.length; i < length; i++) {
         if (radios[i].checked) {
            var contentIdBack = radios[i].value;
            break;
         }
      }
      if (contentIdBack) {
         $.ajax({
            url: '/chosencontent/get/' + contentIdBack,
            type: "GET",
            dataType: "json",
            success: function (data) {
               var content = document.getElementById('content_title');
               content.innerHTML = data;
            },
         });
         var deleteButton = document.getElementById('deleteContent');
         deleteButton.classList.remove("d-none");
      };
   });
});