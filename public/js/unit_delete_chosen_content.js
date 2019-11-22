//wenn Button "Keinen Inhalt verwenden" gedrückt wird dann
$('#deleteContent').click(function () {
   //wenn ein neuer Inhalt eingestellt war
   var content_id = document.getElementById('content_id');
   if (content_id.value !== "") {
      $.ajax({
         url: '/removeContentfromSession',
         type: "GET",
         success: function () {
            var deleteButton = document.getElementById('deleteContent');
            deleteButton.classList.add("d-none");
         },
      });
   }
   //wenn ein vorhandener Inhalt eingestellt war
   // Radio Button Auswahl wieder entfernen
   var radios = document.getElementsByName('chooseContent');
   for (var i = 0, length = radios.length; i < length; i++) {
      if (radios[i].checked) {
         radios[i].checked = false;
         break;
      }
   }
   //im div mit der id "contentTitle" wieder einblenden Du hast noch keinen Inhalt ausgesucht
   var content = document.getElementById('content_title');
   content.innerHTML = 'Du hast noch keinen Inhalt ausgesucht.';
   //Button zum Entfernen des Inhalts wieder ausblenden - Klasse "d-none" hinzufügen
   var deleteButton = document.getElementById('deleteContent');
   deleteButton.classList.add("d-none");
});