
function display_subjects($id) {
  	var subjects_all = document.getElementById("subjects_all_"+$id);
	var subjects_part = document.getElementById("subjects_part_"+$id);
	subjects_part.classList.add("d-none");
	subjects_all.classList.remove("d-none");
}


function hide_subjects($id) {
  	var subjects_all = document.getElementById("subjects_all_"+$id);
	var subjects_part = document.getElementById("subjects_part_"+$id);
	subjects_all.classList.add("d-none");
	subjects_part.classList.remove("d-none");
}



function hide_types($id) {
  	var types_all = document.getElementById("types_all_"+$id);
	var types_part = document.getElementById("types_part_"+$id);
	types_all.classList.add("d-none");
	types_part.classList.remove("d-none");
}

function display_types($id) {
  	var types_all = document.getElementById("types_all_"+$id);
	var types_part = document.getElementById("types_part_"+$id);
	types_part.classList.add("d-none");
	types_all.classList.remove("d-none");
}
