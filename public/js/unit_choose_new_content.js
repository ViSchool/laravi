//wenn neuer Inhalt gespeichert werden soll, hole alle schon im Formular eingetragenen Daten und speichere sie in einer Session Variable bis die Seite wieder aufgerufen wurde
$('#newInstantContentModalCreate').click(function () {
   var title = document.getElementById("block_title")
   if (title.value) {
      sessionStorage.setItem("block_title", title.value);
   }
   var task = document.getElementById("task")
   if (task.value) {
      sessionStorage.setItem("task", task.value);
   }
   var time = document.getElementById("time")
   if (time.value) {
      sessionStorage.setItem("time", time.value);
   }
   var tipp = document.getElementById("tipp")
   if (tipp.value) {
      sessionStorage.setItem("tipp", tipp.value);
   }
});
$(document).ready(function () {
   if (sessionStorage.length !== 0) {
   var title = document.getElementById("block_title");
   title.value = sessionStorage.getItem("block_title");
   var task = document.getElementById("task");
   task.value = sessionStorage.getItem("task");
   var time = document.getElementById("time");
   time.value = sessionStorage.getItem("time");
   var tipp = document.getElementById("tipp");
   tipp.value = sessionStorage.getItem("tipp");
   sessionStorage.clear();
   }
});