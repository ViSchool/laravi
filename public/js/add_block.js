function addElement(parentId, elementTag, elementId, html) {
    // Adds an element to the document
    var p = document.getElementById(parentId);
    var newElement = document.createElement(elementTag);
    newElement.setAttribute('id', elementId);
    newElement.innerHTML = html;
    p.appendChild(newElement);
}

var blockId = 0;
function addBlock() {
	blockId++;
var html = '<div class="card"><div class="card-header" role="tab" id="headingThree"><div class="row"><div class="col-6 float-left"><h4 class="mb-0"><a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">Zusätzliche Inhalte</a></h4><p class="m-0">Hier findest du weitere Inhalte zum Thema</p></div><div class="col-4"><p class="p-3"> <i class="far fa-clock"></i> 20 Minuten</p></div></div></div><div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion"><div class="card-body"><p> Wenn Du bei den Übungen merkst, dass Du noch etwas nicht verstanden hast: Merkzettel zum Rechenweg: <a href="http://vischool.de/einzelne-lerninhalte/?overview_mode=None&SingleProduct=223">Merkzettel</a></p><p>Du weißt gar nicht mehr, was ein Dezimalbruch oder eine Dezimalzahl überhaupt ist? Schau Dir Erklärvideos dazu an:<ul><li> <a href="http://vischool.de/einzelne-Lerninhalte/?categories=5&sub-categories=22&SingleProduct=225">Video 1</a></li><li><a href="http://vischool.de/einzelne-Lerninhalte/?categories=5&sub-categories=22&SingleProduct=226">Video 2</a></li></ul></p></div></div></div></div></div>';
	addElement ('accordion','p','block-' + blockId, html);
}
