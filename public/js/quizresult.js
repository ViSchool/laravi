function myResultFunction() {
	var addPoint = 0;
	var finalResult = {!! json_encode($finalResult) !!};
    
    var sol1 = document.getElementById("guess1");
    if (sol1 != null) {
    	var solution1 = {!! json_encode($question->solution1) !!};
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
    	var solution2 = {!! json_encode($question->solution2) !!};
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
    	var solution3 = {!! json_encode($question->solution3) !!};
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
    	var solution4 = {!! json_encode($question->solution4) !!};
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
    	var solution5 = {!! json_encode($question->solution5) !!};
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
