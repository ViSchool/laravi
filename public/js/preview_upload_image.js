function readURL(input) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
         $('#imgUpload').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
   }
}

$("#imgInp").change(function () {
   var element1 = document.getElementById("noImage");
   element1.classList.add("d-none");
   var element2 = document.getElementById("hasImage");
   element2.classList.remove("d-none");
   readURL(this);
});