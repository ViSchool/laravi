<!DOCTYPE html>
<html>
<head>
	<title> #Social4 Presentation </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
</head>
<body>
<div class="container">
		<h1 class="mb-5 mt-5 text-center">Filter Tweets</h1>
		<hr></hr>
		<div class="row mb-5 d-flex">
			<ul class="nav nav-tabs">
				<li class="nav-item">
	    			<a class="nav-link active" href="/hack"><h3>All</h3></a>
	  			</li>
				<li class="nav-item">
					<a class="nav-link" href="/hack/influencer"><h3>Influencer</h3></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/hack/standard"><h3>Standard</h3></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/hack/newbie"><h3>Newbie</h3></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/hack/celebrity"><h3>Celebrity</h3></a>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="container p-5">	
	<div class="flex-row d-flex justify-content-around align-items-center">
		<div class="m-2 border-0 card mb-5" style="width: <?php echo e($ballPositive); ?>rem;">
			<img class="card-img rounded-circle" src="/images/neutral.jpeg" alt="Card image">
				<div class="card-img-overlay d-flex justify-content-center">
					<h2 class="card-text text-center text-warning" style="font-size: <?php echo e($textPositive); ?>rem; position: relative;"></h2>
				</div>
				<h3 class="text-center">positive</h3>
		</div>
		
			<div class="m-2 border-0 card mb-5" style="width: <?php echo e($ballNeutral); ?>rem;">
				<img class="card-img rounded-circle" src="/images/positive.jpeg" alt="Card image">
				<div class="card-img-overlay d-flex flex-column justify-content-center">
					<h2 class="card-text text-info text-center" style="font-size: <?php echo e($textNeutral); ?>rem;"></h2>
				</div>
				<h3 class="text-center">neutral</h3>
			</div>
		
			<div class="m-2 border-0 card mb-5 d-flex align-items-center" style="width: <?php echo e($ballNegative); ?>rem;">
				<img class="card-img rounded-circle" src="/images/negative.jpeg" alt="Card image">
				<div class="card-img-overlay d-flex flex-column justify-content-center">
					<h2 class="card-text text-info text-center" style="font-size: <?php echo e($textNegative); ?>rem; position: relative;"></h2>
				</div>
				<h3 class="text-center">negative</h3>
			</div>
	</div>
	
	<div class="container">
<div class="row d-flex justify-content-between">	
		<a href="#"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
		<input type="text" value="April"/>
		<a href="#"><i class="fas fa-chevron-circle-right fa-3x"></i></a>
</div>

	
	<!-- Rude? -->
	<hr></hr>
	<div class="flex-row d-flex justify-content-around align-items-center mt-5 mb-5">
		<div class="m-2 border-0 card mb-5" style="width: <?php echo e($ballRude); ?>rem;">
			<img class="card-img rounded-circle" src="/images/rude.jpeg" alt="Card image">
				<div class="card-img-overlay d-flex justify-content-center">
					<h2 class="card-text text-center" style="font-size: <?php echo e($textRude); ?>rem; position: relative;">vulgar</h2>
				</div>
		</div>
		
			<div class="m-2 border-0 card mb-5" style="width: <?php echo e($ballNotRude); ?>rem;">
				<img class="card-img rounded-circle" src="/images/notrude.jpeg" alt="Card image">
				<div class="card-img-overlay d-flex justify-content-center">
					<h2 class="card-text text-center text-white" style="font-size: <?php echo e($textNotRude); ?>rem;">not vulgar</h2>
				</div>
			</div>
	
	</div>	


<div class="container">
<div class="row d-flex justify-content-between">	
		<a href="#"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
		<input type="text" value="April"/>
		<a href="#"><i class="fas fa-chevron-circle-right fa-3x"></i></a>
</div>

</div>	
	
</body>

</html>