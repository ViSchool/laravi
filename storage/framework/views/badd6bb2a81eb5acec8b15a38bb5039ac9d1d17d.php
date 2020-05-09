<?php
   //Status der Bearbeitung für Progressbar definieren
   $progress=NULL;
   $progress_text=NULL;
   $progresscolor=NULL;

   if(count($tasks) == count($tasks->where('taskStatus_id',8))) {
      $progress = 100;
      $progress_text = 'Die Lerneinheit ist archiviert';
      $progresscolor = 'yellow';
   }
   if (count($tasks) == count($tasks->where('taskStatus_id',2))) {
      $progress = 10;
      $progress_text = $student->student_name . ' hat die Lerneinheit noch nicht begonnen.';
      $progresscolor = 'yellow';
   }
   if (count($tasks) == count($tasks->where('taskStatus_id',3))) {
      $progress = 20;
      $progress_text = $student->student_name . ' hat die Lerneinheit begonnen.';
      $progresscolor = 'yellow';
   }
   if (count($tasks->where('taskStatus_id',4)) > 0) {
      $progress = 40;
      $progress_text = 'Es gibt noch eine unbeantwortete Nachricht von' . $student->student_name;
      $progresscolor = 'yellow';
   }
   if (count($tasks->where('taskStatus_id',5)) > 0) {
      $progress = 60;
      $progress_text =  $student->student_name .' bearbeitet die Lerneinheit gerade.';
      $progresscolor = 'orange';

   }
   if (count($tasks->where('taskStatus_id',6)) > 0) {
      $progress = 60;
      $progress_text =  $student->student_name .' bearbeitet die Lerneinheit gerade, du musst noch Rückmeldungen zu Ergebnissen geben.';
      $progresscolor = 'green';

   }
   if ((isset($progress)  == false) or isset($progress_text) == false) {
      $progress = 10;
      $progress_text = 'Der Status ist unbekannt.';
      $progresscolor = 'grey';
   }
?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_components/unitStatusForTasks.blade.php ENDPATH**/ ?>