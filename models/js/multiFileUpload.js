window.onload = initMultiFile;
var nbrFiles = 0;
var maxFile = 5;
function initMultiFile(){
	createInput();
	//Création du paragraphe qui va se trouver dans le div filesList
	var paragraphForFilesList = document.createElement('p');
	paragraphForFilesList.id = 'titleFilesList';
	var text = document.createTextNode('Images (maximum '+maxFile+'):');
	paragraphForFilesList.appendChild(text);
	//Ajout du pragraphe dans le div
	var filesList = document.getElementById('filesList');
	filesList.appendChild(paragraphForFilesList);
}
function createInput(){
	if(nbrFiles < maxFile){
		//Création de l'élément input
		var input = document.createElement('input');
		input.type = 'file';
		input.name = 'image';
		//Lorsqu'un fichier est choisi, on ajoute son nom à la liste
		input.onchange = function() { 
			addFile(this);
		}
		//Ajout de l'input au document
		var paragraphForInput = document.getElementById('inputFile');
		paragraphForInput.appendChild(input);
	}
}
function addFile(input){
	nbrFiles ++;
	var paragraphForFilesList =  document.getElementById('filesList');
	//Création de la ligne dans la liste des fichiers à uploader
	var file = document.createElement("p");
	//Image de suppression
	var image = document.createElement('img');
	image.src = 'views/images/icones/delete.png';
	image.alt = 'supprimer';
	//Lien pour supprimer
	var link = document.createElement('a');
	link.href= '#formUpload';
	link.onclick = function () {
		deleteFile(file, input);
	}
	//Ajout de l'image dans la balise de lien
	link.appendChild(image);
	//Ajout du lien à la ligne de la liste
	file.appendChild(link);
	//Ajout du nom du fichier
	file.appendChild(document.createTextNode(" " + getFileName(input.value)));
	//Ajout de l'item à la liste
	paragraphForFilesList.appendChild(file);
	//Affectation de l'attribut name de l'input
	input.name = getFileName(input.value);
	//Création d'un nouvel input pour un nouveau fichier
	input.style.display = 'none';
	createInput();
}
function getFileName(fileName){
  if (fileName != "") {
    if (fileName.match(/^(\\\\|.:)/)) {
      var temp = new Array();
      temp = fileName.split("\\");
      var len = temp.length;
      fileName = temp[len-1];
    } else {
      temp = fileName.split("/");
      var len = temp.length;
      if(len>0)
        fileName = temp[len-1];
    }
  }  
  return fileName;
}
function deleteFile(item,input){
	nbrFiles--;
	if(nbrFiles == maxFile-1){
		createInput();
	}
	var paragraphForInput = document.getElementById('inputFile');
	paragraphForInput.removeChild(input);
	var paragraphForFilesList = document.getElementById('filesList');
	paragraphForFilesList.removeChild(item);
}