<?php $__env->startSection('stylesheets'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container p-3">
	<h4>Einzelne Lerninhalte</h4>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>



<div id="embedded-content" class="container mt-3">	
	<div class="row">
		<div class="col">
			<h3><?php echo e($content->content_title); ?></h3>
		</div>
	</div>
	<div class="row">
		<div class="col">	
			<?php echo $__env->make('components.rating_stars',['$average_score' => $average_score], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		<div class="col">
			<div class="d-flex flex-row-reverse mb-1">
			<button type="button" class="btn-sm btn-outline-danger" id="open"> Fehler entdeckt ?</button>
			</div>
		</div>
	</div>

	<hr>
	<?php if(\Session::has('success')): ?>
    	<div class="alert alert-success">
         <p><?php echo \Session::get('success'); ?></p>
    	</div>
	<?php endif; ?>
	<div class="row">
		<div id="contentToPrint" class="col">	
			<?php switch($content->tool_id): 
				case (1): ?>
					<div class="embed-responsive embed-responsive-<?php echo e($aspect_ratio); ?>">
						<iframe src="https://www.youtube-nocookie.com/embed/<?php echo e($content->toolspecific_id); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				<?php break; ?>
				<?php case (4): ?>
					<div style="overflow:auto;-webkit-overflow-scrolling:touch">
						<div class="container">
							<a href="<?php echo e($content->content_link); ?>"><small class="text-muted">Quelle: <?php echo e($content->content_link); ?></small></a>
						</div>
						<iframe src="<?php echo e($content->content_link); ?>" width="100%" height="600" allowfullscreen>Der Browser zeigt leider das Dokument nicht richtig an. Hier ist der Inhalt zum Anschauen in einem neuen Fenster: <a href="<?php echo e($content->content_link); ?>"><?php echo e($content->content_title); ?></a></iframe>
					</div>
				<?php break; ?>
				<?php case (5): ?> 
					<div class="d-flex justify-content-end">
						<a href="<?php echo e($content->content_link); ?>"> Als PDF öffnen <i class="far fa-file-pdf fa-2x" style="color:red"></i> </a>			
					</div>
					<object id="obj" data="<?php echo e($content->content_link); ?>" ></object>	
				<?php break; ?>
				<?php case (6): ?> 
					<div style="overflow:auto;-webkit-overflow-scrolling:touch">
						<p><iframe src="https://h5p.org/h5p/embed/<?php echo e($content->toolspecific_id); ?>" frameborder="0" allowfullscreen="allowfullscreen" style="width:70% "></iframe><script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script></p>
					</div>
					<div class="row">
						<button class="btn btn-primary" onClick="window.print()">Ergebnisse drucken/speichern</button>
					</div>
				<?php break; ?>
				<?php case (7): ?>
					<div class="embed-responsive embed-responsive-16by9">
						<iframe src="https://player.vimeo.com/video/<?php echo e($content->toolspecific_id); ?>?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>
				<?php break; ?>
				
				<?php case (10): ?> 
					<div style="overflow:auto;-webkit-overflow-scrolling:touch">
						<p><iframe src="https://moodle.vischool.net/mod/hvp/embed.php?id=<?php echo e($content->toolspecific_id); ?>" frameborder="0" allowfullscreen="allowfullscreen" style="width:70% "></iframe><script src="https://moodle.vischool.net/mod/hvp/library/js/h5p-resizer.js" charset="UTF-8"></script></p>
					</div>
					<div class="row">
						<button class="btn btn-primary" onClick="window.print()">Ergebnisse drucken/speichern</button>
					</div>
				<?php break; ?>
			<?php endswitch; ?>
		</div>	
	</div>
	<?php if($question != null): ?>
	<div class="row mt-3">
		<div class="col">
			<div class="d-flex flex-row-reverse my-2">
				<button type="button" class="btn-sm btn-info" id="question"> Alles verstanden? Teste Dich selbst!</button>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php
		 $previous = URL::previous();
		 if(strpos($previous, 'lerneinheit')) {
			 $back = 1;
		 } else {
			 $back = 0;
		 }
	?>
	<?php if($back == 1): ?>
	<div class="d-flex justify-content-center mt-3">
		<a href="<?php echo e(URL::previous()); ?>" class="btn-sm btn-warning btn-block text-center" id="back"> Zurück zur Lerneinheit</a>
	</div>
	<?php endif; ?>
	<hr>
</div>




<!-- Block Berwertung -->
<div class="container">
	<h3>Bewerten</h3>
	<form action="/reviews" method="POST">
		<?php echo e(csrf_field()); ?>

		<!-- AHA Review -->
		<div class="row">
			<div class="col-md row-sm">
				<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
	 				<img class="img-fluid ml-0 mr-1" src="/images/logo_aha.jpg" alt="AHA!" width="60"></img>
	 				<div class="pt-2">
						<div class="rating">
							<input id="star1_aha" type="radio" name="aha_score" value="5">
							<label for="star1_aha"></label>
							<input id="star2_aha" type="radio" name="aha_score" value="4">
							<label for="star2_aha"></label>
							<input id="star3_aha" type="radio" name="aha_score" value="3">
							<label for="star3_aha"></label>
							<input id="star4_aha" type="radio" name="aha_score" value="2">
							<label for="star4_aha"></label>
							<input id="star5_aha" type="radio" name="aha_score" value="1">
							<label for="star5_aha"></label>
						</div>
					</div>
				</div>
			</div>	
			
			<!-- COOL Review -->	
			
			<div class="col-md row-sm">
				<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
	 				<img class="img-fluid ml-0 mr-1" src="/images/logo_cool.jpg" alt="COOL!" width="60"></img>
	 				<div class="pt-2">
						<div class="rating">
							<input id="star1_cool" type="radio" name="cool_score" value="5">
							<label for="star1_cool"></label>
							<input id="star2_cool" type="radio" name="cool_score" value="4">
							<label for="star2_cool"></label>
							<input id="star3_cool" type="radio" name="cool_score" value="3">
							<label for="star3_cool"></label>
							<input id="star4_cool" type="radio" name="cool_score" value="2">
							<label for="star4_cool"></label>
							<input id="star5_cool" type="radio" name="cool_score" value="1">
							<label for="star5_cool"></label>
						</div>
					</div>
				</div>
			</div>
				
			<!-- WIRKT Review -->	
			
	 		<div class="col-md row-sm">
				<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
	 				<img class="img-fluid ml-0 mr-1" src="/images/logo_wirkt.jpg" alt="WIRKT!" width="60"></img>
	 				<div class="pt-2">
	 					<div class="rating">
							<input id="star1_wirkt" type="radio" name="wirkt_score" value="5">
							<label for="star1_wirkt"></label>
							<input id="star2_wirkt" type="radio" name="wirkt_score" value="4">
							<label for="star2_wirkt"></label>
							<input id="star3_wirkt" type="radio" name="wirkt_score" value="3">
							<label for="star3_wirkt"></label>
							<input id="star4_wirkt" type="radio" name="wirkt_score" value="2">
							<label for="star4_wirkt"></label>
							<input id="star5_wirkt" type="radio" name="wirkt_score" value="1">
							<label for="star5_wirkt"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<div class="row mt-3">
			<div class="col">
			<textarea class="form-control" name="review_comment" id="review_comment" rows="3" placeholder="Was hat Dir gefallen oder nicht? Wofür hast Du gelernt?"></textarea>	
				<input type="hidden" name="review_unit_id" value="0"/>
				<input type="hidden" name="review_content_id" value="<?php echo e($content->id); ?>"/>
			</div>
		</div>	
		<div class="row">
			<div class="col">
				<button class="mt-3 btn btn-info" type="submit">Bewertung abschicken</button>
			</div>
		</div>
	</form>
</div>


<!-- Inhalt Modal "Fehler melden" -->
<div class="modal fade" id="fehlerModal" tabindex="-1" role="dialog" aria-labelledby="fehlerModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Fehler für <?php echo e($content->content_title); ?> melden</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<form action="/mistakes" method="POST">
			<?php echo e(csrf_field()); ?>

				<div class="modal-body">
					<select class="mb-3 form-control" id="type" name="type">
						<option value="">Bitte Art des Fehlers auswählen</option>
						<option>Technischer Fehler</option>
						<option>Inhaltsfehler</option>
					</select>
					<textarea class="form-control" id="mistake_description" name="mistake_description" placeholder="Beschreibe den Fehler etwas genauer: an welcher Stelle ist der Fehler? Was wäre richtig? Wenn es sich um eintechnisches Problem handelt, welches Endgerät/Browser hast Du benutzt?"><?php echo e(old('mistake_description')); ?></textarea>
					<input id="mistake_content_id" name="mistake_content_id" type="hidden" value="<?php echo e($content->id); ?>" />
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn-sm btn-primary">Fehler senden</button>
				</div>
			</form>
		</div>
	</div>
</div>
<hr></hr>

<?php if($question != null): ?> 
<!-- Inhalt Modal "Teste Dich selbst!" -->
<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="testModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Testfrage für <?php echo e($content->content_title); ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="bg-secondary p-2 text-white">
					<p><?php echo e($question->question); ?></p>
					<small>
						<?php if($correctAnswers > 1): ?> 
						(mehrere Antworten sind richtig)
						<?php else: ?>
						(eine Antwort ist richtig)
						<?php endif; ?>
					</small>
				</div>
				<ul class="list-group">
					<?php if(isset($question->answer1)): ?>
					<li class="list-group-item">
						<div class="d-flex justify-content-start align-items-center">
							<input type="checkbox" id="guess1" name="guess1"/>
							<span class="ml-3"><?php echo e($question->answer1); ?></span>
							<span id="correct1" class="ml-auto"></span>
						</div>
					</li>
					<?php endif; ?>
					<?php if(isset($question->answer2)): ?>
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess2" name="guess2"/>
							<span class="ml-3"><?php echo e($question->answer2); ?></span>
							<span id="correct2" class="ml-auto"></span>
						</div>
					</li>
					<?php endif; ?>
					<?php if(isset($question->answer3)): ?>
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess3" name="guess3"/>
							<span class="ml-3"><?php echo e($question->answer3); ?></span>
							<span id="correct3" class="ml-auto"></span>
						</div>
					</li>
					<?php endif; ?>
					<?php if(isset($question->answer4)): ?>
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess4" name="guess4"/>
							<span class="ml-3"><?php echo e($question->answer4); ?></span>
							<span id="correct4" class="ml-auto"></span>
						</div>
					</li>
					<?php endif; ?>
					<?php if(isset($question->answer5)): ?>
					<li class="list-group-item">
						<div class="d-flex justify-content-start">
							<input type="checkbox" id="guess5" name="guess5"/>
							<span class="ml-3"><?php echo e($question->answer5); ?></span>
							<span id="correct5" class="ml-auto"></span>
						</div>
					</li>
					<?php endif; ?>
				</ul>
			</div>
				<div class="modal-footer d-flex justify-content-between">
					<p id="correct"></p>
					
					<button class="btn btn-primary ml-auto" onclick="myResultFunction()">Lösung prüfen</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if($relatedContents->count() > 0): ?>
<div class="container">
	<div class="row">
		<div class="col-4 pt-5">
			<h4>Ähnliche Inhalte:</h4>
		</div>
	</div>
	<div class="row">
		<?php $__currentLoopData = $relatedContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="d-flex justify-content-around">
				<div class="card m-3" style="width:200px">
					<?php if(isset($relatedContent->content_img_thumb)): ?>
						<a href="/content/<?php echo e($relatedContent->id); ?>"><img class="card-img-top" src="/images/contents/<?php echo e($relatedContent->content_img); ?>" alt="Bild:<?php echo e($relatedContent->content_title); ?>"></img></a>
					<?php endif; ?>
					<?php if(empty($relatedContent->content_img_thumb)): ?> 
						<?php switch($relatedContent->tool_id):
							case (1): ?>
								<a href="/content/<?php echo e($relatedContent->id); ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?php echo e($relatedContent->toolspecific_id); ?>/mqdefault.jpg"></img></a>
							<?php break; ?>
							<?php case (7): ?>
								<a href="/content/<?php echo e($relatedContent->id); ?>"><img class="card-img-top" src="<?php echo e($relatedContent->img_thumb_url); ?>"></img></a>
							<?php break; ?>
							<?php default: ?>
								<?php if(isset($relatedContent->portal->portal_img)): ?>
									<a href="/content/<?php echo e($relatedContent->id); ?>"><img class="card-img-top" src="/images/portals/<?php echo e($relatedContent->portal->portal_img); ?>"></img></a>
								<?php endif; ?>
						<?php endswitch; ?>
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>
<?php endif; ?>


<hr></hr>
<?php if($content->reviews->count() > 0): ?>
<div class="container">
	<h3>Vorhandene Bewertungen</h3>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
	
<?php $__env->startSection('scripts'); ?>


<?php if(count($errors)): ?>
<script>
$(function() {
    $("#fehlerModal").modal();
});
</script>
<?php endif; ?>


<script>
$(document).ready(function(){
    $("#open").click(function(){
        $("#fehlerModal").modal();
    });
});</script>

<?php if($question != null): ?>
<script>
$(document).ready(function(){
    $("#question").click(function(){
        $("#testModal").modal();
    });
});</script>

<script>
function myResultFunction() {
	var addPoint = 0;
	var finalResult = <?php echo json_encode($finalResult); ?>;
    
    var sol1 = document.getElementById("guess1");
    if (sol1 != null) {
    	var solution1 = <?php echo json_encode($question->solution1); ?>;
    	var sol1 = document.getElementById("guess1").checked;
    	if (sol1 == true) {
    		if (solution1 == 1) {
    			addPoint ++;
    			document.getElementById("correct1").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct1").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution1 == 0) {
				addPoint ++;
				document.getElementById("correct1").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct1").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
	}

    var sol2 = document.getElementById("guess2");
    if (sol2 != null) {
    	var solution2 = <?php echo json_encode($question->solution2); ?>;
    	var sol2 = document.getElementById("guess2").checked;
    	if (sol2 == true) {
			if (solution2 == 1) {
    			addPoint ++;
    			document.getElementById("correct2").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct2").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution2 == 0) {
				addPoint ++;
				document.getElementById("correct2").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct2").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
	}

    var sol3 = document.getElementById("guess3");
    if (sol3 != null) {
    	var solution3 = <?php echo json_encode($question->solution3); ?>;
    	var sol3 = document.getElementById("guess3").checked;
    	if (sol3 == true) {
			if (solution3 == 1) {
    			addPoint ++;
    			document.getElementById("correct3").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct3").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution3 == 0) {
				addPoint ++;
				document.getElementById("correct3").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct3").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
	}
    
    var sol4 = document.getElementById("guess4");
    if (sol4 != null) {
    	var solution4 = <?php echo json_encode($question->solution4); ?>;
    	var sol4 = document.getElementById("guess4").checked;
    	if (sol4 == true) {
			if (solution4 == 1) {
    			addPoint ++;
    			document.getElementById("correct4").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
				document.getElementById("correct4").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution4 == 0) {
				addPoint ++;
				document.getElementById("correct4").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct4").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
    }
    
    var sol5 = document.getElementById("guess5");
    if (sol5 != null) {
    	var solution5 = <?php echo json_encode($question->solution5); ?>;
    	var sol5 = document.getElementById("guess5").checked;
    	if (sol5 == true) {
			if (solution5 == 1) {
    			addPoint ++;
    			document.getElementById("correct5").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct5").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
		else {
			if (solution5 == 0) {
				addPoint ++;
				document.getElementById("correct5").innerHTML = '<i class="fas fa-check" style="color:green"></i>';
			}
			else {
			    document.getElementById("correct5").innerHTML = '<i class="fas fa-times" style="color:red"></i>';
			}
		}
    }
    
    if (addPoint == finalResult) {
    document.getElementById("correct").innerHTML = "Richtig";
	}
	else {
    document.getElementById("correct").innerHTML = "Falsch";
	}
}

</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/contents/show_contents.blade.php ENDPATH**/ ?>