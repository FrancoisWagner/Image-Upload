//**************************************************************************
// Fonction permettant de cacher la message box lorsque l'on tape sur la touche Enter
//**************************************************************************
function keyHit(evt){
	var thisKey = (evt) ? evt.which:window.event.keyCode;
	var enterKey = 13;
	if(thisKey == enterKey){
		if(document.getElementById('filter')){
			hide('filter');
			hide('box');
		}
		if(document.getElementById('filterUserFolder')){
			hide('filterUserFolder');
			hide('boxUserFolder');
		}
	}
}
//**************************************************************************
// Fonction permettant de cacher un element
//**************************************************************************
function hide(id){
	document.getElementById(id).style.display = 'none';
}
//**************************************************************************
// Fonction permettant de d'afficher un élement
//**************************************************************************
function show(id){
	document.getElementById(id).style.display = 'block';
}
//**************************************************************************
// Fonction permettant d'ajouter une message box
//**************************************************************************
function alertMessage(message){
	var box = document.createElement('div');
	var content = document.getElementById('middle');
	box.innerHTML = '<script type="text/javascript">document.onkeydown = keyHit;</script><div id="filter"></div><div id="box" ><div id="boxheader"><span id="boxtitle">Message d\'avertissement</span><span id="boxclose" onclick="javascript:hide(\'filter\');javascript:hide(\'box\');"><a href="#">Fermer/Taper sur enter</a></span></div><div id="boxcontent">'+message+'</div></div>';
	content.appendChild(box);
}
//**************************************************************************
// Fonction permettant de cocher toutes les checkboxs d'un formulaire
//**************************************************************************
function checkAll(elementsId,check){
	var nbrElements = document.getElementById(elementsId+'Size').value;
	var elementsCheckbox = document.getElementsByTagName('input');
	var re = new RegExp(elementsId+'[0-9]+');
	var j = 0;
	for(var i=0;i<elementsCheckbox.length;i++){
		if(re.test(elementsCheckbox[i].id)){
			if(j<nbrElements){
				elementsCheckbox[i].checked = check;
			}
			j++;
		}
	}
}
//**************************************************************************
// Fonction permettant de décocher toutes les checkboxs d'un formulaire
//**************************************************************************
function uncheckAll(elementsId){
	var elementsCheckbox = document.getElementsByTagName('input');
	var re = new RegExp(elementsId+'[0-9]+');
	for(var i=0;i<elementsCheckbox.length;i++){
		if(re.test(elementsCheckbox[i].id)){
				elementsCheckbox[i].checked = false;
		}
	}
	var inputCheckboxAll = document.getElementById('checkboxAll'+elementsId);
	inputCheckboxAll.checked = false;
	inputCheckboxAll.disabled = true;
	inputCheckboxAll.style.display = 'none';
}
//**************************************************************************
// Fonction permettant de supprimer une catégorie
//**************************************************************************
function deleteCategory(id){
	BoiteDeConfirmation = confirm('Voulez-vous vraiment supprimer cette entrée ?');
	if(BoiteDeConfirmation == true){
		Data2Delete = id;
		var node = document.getElementById('category'+id);
		var parentNode = node.parentNode;
		var parentOfParentNode = parentNode.parentNode;
		var parent = parentOfParentNode.parentNode;
		parent.removeChild(parentOfParentNode);
		var xhr;
		if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
		else{
		    alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		    return;
		}
		xhr.open('POST','models/ajaxUserFolder.php',true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState < 4){
				var imageLoading = document.createElement('img');
				imageLoading.src = 'views/images/loading.gif';
				document.getElementById('categories').appendChild(imageLoading);
			}
			else{
				if(xhr.status == 200){
					if(xhr.responseText != ''){
						document.getElementById('categories').innerHTML = xhr.responseText;
					}
				}
				else{
					alert('Status != 200');
				}
		    }
		}
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		var data = 'deleteCategory='+ escape(Data2Delete);
		xhr.send(data);
	}
	else{
		alert("Action annulée.");
	}
}
//**************************************************************************
// Fonction permettant de supprimer une image
//**************************************************************************
function deleteImage(id){
	BoiteDeConfirmation = confirm('Voulez-vous vraiment supprimer cette entrée ?');
	if(BoiteDeConfirmation == true){
		Data2Delete = id;
		var node = document.getElementById('image'+id);
		var parentNode = node.parentNode;
		var parentOfParentNode = parentNode.parentNode;
		var parent = parentOfParentNode.parentNode;
		parent.removeChild(parentOfParentNode);
		var xhr;
		if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
		else{
		    alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		    return;
		}
		xhr.open('POST','models/ajaxUserFolder.php',true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState < 4){
				var imageLoading = document.createElement('img');
				imageLoading.src = 'views/images/loading.gif';
				document.getElementById('images').appendChild(imageLoading);
			}
			else{
				if(xhr.status == 200){
					if(xhr.responseText != ''){
						document.getElementById('images').innerHTML = xhr.responseText;
					}
				}
				else{
					alert('Status != 200');
				}
		    }
		}
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		var data = 'deleteImage='+ escape(Data2Delete);
		xhr.send(data);
	}
	else{
		alert("Action annulée.");
	}
}
//**************************************************************************
// Fonction permettant de déterminer toutes les checkboxs qui ont été cochées
//**************************************************************************
var CheckNb = 0;
function getCheck(type){
	CheckNb = 0;
	TotalInputs = document.getElementsByTagName('input').length;
	Data2Delete = '';
	var array = new Array();
	for(i = 0; i != TotalInputs; i++){
		if(document.getElementsByTagName('input')[i].type == 'checkbox'){
			if(document.getElementsByTagName('input')[i].checked == true){
				var re = new RegExp(type+'[0-9]+');
				if(re.test(document.getElementsByTagName('input')[i].id)){
					Data2Delete = Data2Delete + "  " + document.getElementsByTagName('input')[i].id;
					array[CheckNb] = document.getElementsByTagName('input')[i].id;
					CheckNb++;
				}
			}
		}
	}
	for(i = 0; i < array.length; i++){
		var node = document.getElementById(array[i]);
		var parentNode = node.parentNode;
		var parentOfParentNode = parentNode.parentNode;
		var parent = parentOfParentNode.parentNode;
		parent.removeChild(parentOfParentNode);
	}
	return Data2Delete;
}
//**************************************************************************
// Fonction permettant de supprimer les catégories cochées
//**************************************************************************
function deleteCategoryChecked(){
	BoiteDeConfirmation = confirm('Voulez-vous vraiment supprimer cette entrée ?');
	if(BoiteDeConfirmation == true){
		Data2Delete = getCheck('category');
		var xhr;
		if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
		else{
		    alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		    return;
		}
		xhr.open('POST','models/ajaxUserFolder.php',true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState < 4){
				var imageLoading = document.createElement('img');
				imageLoading.src = 'views/images/loading.gif';
				document.getElementById('categories').appendChild(imageLoading);
			}
			else{
				if(xhr.status == 200){
					if(xhr.responseText != ''){
						document.getElementById('categories').innerHTML = xhr.responseText;
					}
				}
				else{
					alert('Status != 200');
				}
		    }
		}
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		var data = 'elementsCategories='+ escape(Data2Delete) + '&nb_elementsCategories=' + CheckNb;
		xhr.send(data);
	}
	else{
		alert("Action annulée.");
	}
	var inputCheckboxAll = document.getElementById('checkboxAllcategory');
	inputCheckboxAll.checked = false;
}
//**************************************************************************
// Fonction permettant de supprimer les images cochées
//**************************************************************************
function deleteImagesChecked(){
	BoiteDeConfirmation = confirm('Voulez-vous vraiment supprimer cette entrée ?');
	if(BoiteDeConfirmation == true){
		Data2Delete = getCheck('image');
		var xhr;
		if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
		else{
		    alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		    return;
		}
		xhr.open('POST','models/ajaxUserFolder.php',true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState < 4){
				var imageLoading = document.createElement('img');
				imageLoading.src = 'views/images/loading.gif';
				document.getElementById('images').appendChild(imageLoading);
			}
			else{
				if(xhr.status == 200){
					if(xhr.responseText != ''){
						document.getElementById('images').innerHTML = xhr.responseText;
					}
				}
				else{
					alert('Status != 200');
				}
		    }
		}
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		var data = 'elementsImages='+ escape(Data2Delete) + '&nb_elementsImages=' + CheckNb;
		xhr.send(data);
	}
	else{
		alert("Action annulée.");
	}
	var inputCheckboxAll = document.getElementById('checkboxAllimage');
	inputCheckboxAll.checked = false;
}
//**************************************************************************
// Fonction permettant d'afficher une la miniature de l'image et ses codes lorsque l'on clique dessus depuis le dossier utilisateur
//**************************************************************************
function showImage(folder,name){
	var boxTitle = document.getElementById('boxtitleUserFolder');
	var boxContent = document.getElementById('boxcontentUserFolder');
	boxTitle.innerHTML = '';
	boxTitle.innerHTML = name;
	boxContent.innerHTML = '';
	boxContent.innerHTML = '<div class="imageHebergee"><a href="'+folder+name+'" target="blank"><img src="'+folder+'miniatures/petites/'+name+'" alt="" /></a></div><div class="code"><p><span class="linkImage">URL de l\'image:</span><br /><input onFocus=\'this.select();\' type="text" size="58" value="http://www.image-upload.ch/upload/'+folder+name+'" /></p><br /><p><span class="bbCode">BBcode:</span><br />600px: <input onFocus=\'this.select();\' type="text" size="50" value="[url=http://www.image-upload.ch/'+folder+name+'][img]http://image-upload.ch/upload/'+folder+'miniatures/grandes/'+name+'[/img][/url]" /><br />300px: <input onFocus=\'this.select();\' type="text" size="50" value="[url=http://www.image-upload.ch/'+folder+name+'][img]http://image-upload.ch/upload/'+folder+'miniatures/moyennes/'+name+'[/img][/url]" /></p><br /><p><span class="zCode">Zcode:</span><br />600px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<lien url="http://www.image-upload.ch/'+folder+name+'"><image>http://image-upload.ch/upload/'+folder+'miniatures/grandes/'+name+'</image></lien>\' /><br />300px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<lien url="http://www.image-upload.ch/'+folder+name+'"><image>http://image-upload.ch/upload/'+folder+'miniatures/moyennes/'+name+'</image></lien>\' /></p><br /><p><span class="html">HTML:</span><br />600px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<a href="http://www.image-upload.ch/'+folder+name+'"><img src="http://image-upload.ch/upload/'+folder+'miniatures/grandes/'+name+'" alt="" /></a>\' /><br />300px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<a href="http://www.image-upload.ch/'+folder+name+'"><img src="http://image-upload.ch/upload/'+folder+'miniatures/moyennes/'+name+'" alt="" /></a>\' /></p></div>';
	show('filterUserFolder');
	show('boxUserFolder');
}
//**************************************************************************
// Fonction d'ajouter une catégorie
//**************************************************************************
function addCategory(){
	var newCategory = document.getElementById('category').value;
	var xhr;
	if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
	else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
	else{
		alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		return;
	}
	xhr.open('POST','models/ajaxUserFolder.php',true);
	xhr.onreadystatechange = function(){
		if(xhr.readyState < 4){
			var imageLoading = document.createElement('img');
			imageLoading.src = 'views/images/loading.gif';
			document.getElementById('categories').appendChild(imageLoading);
		}
		else{
			if(xhr.status == 200){
				if(xhr.responseText != ''){
					document.getElementById('categories').innerHTML = xhr.responseText;
				}
			}
			else{
				alert('Status != 200');
			}
		}
	}
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	var data = 'category='+ escape(newCategory);
	xhr.send(data);
}
//**************************************************************************
// Fonction de déplacement des images dans une catégorie
//**************************************************************************
function moveImages(){
	var category = document.getElementById('categoryToMove').value;
	if(category != 'Déplacer'){
		var Data2Move = getCheck('image');
		var xhr;
		if(window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
		else{
			alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
			return;
		}
		xhr.open('POST','models/ajaxUserFolder.php',true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState < 4){
				var imageLoading = document.createElement('img');
				imageLoading.src = 'views/images/loading.gif';
				document.getElementById('images').appendChild(imageLoading);
			}
			else{
				if(xhr.status == 200){
					if(xhr.responseText != ''){
						document.getElementById('images').innerHTML = xhr.responseText;
					}
				}
				else{
					alert('Status != 200');
				}
			}
		}
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		var data = 'categoryToMove='+ category + '&imagesToMove=' + Data2Move + '&nb_elementsImagesMove=' + CheckNb;
		xhr.send(data);
	}
	
}
//**************************************************************************
// Fonction permettant d'afficher le formulaire de redimensionnement
//**************************************************************************
function showResize(id,name){
	var boxTitle = document.getElementById('boxtitleUserFolder');
	var boxContent = document.getElementById('boxcontentUserFolder');
	boxTitle.innerHTML = '';
	boxTitle.innerHTML =  'Redimensionnement de l\'image '+name;
	boxContent.innerHTML = '';
	boxContent.innerHTML = '<form method="post" action="userFolder.html"><p><input type="hidden" id="id_modif" name="id_modif" value="'+id+'" /><label for="prop_largeur">Redimensionner proportionnellement à la largeur</label>: <input type="checkbox" name="prop_largeur" id="prop_largeur" onclick="desactive(\'hauteur\',\'largeur\',\'prop_hauteur\',\'prop_largeur\');" /><br /><label for="prop_hauteur">Redimensionner proportionnellement à la hauteur</label>: <input type="checkbox" name="prop_hauteur" id="prop_hauteur" onclick="desactive(\'largeur\',\'hauteur\',\'prop_largeur\',\'prop_hauteur\');" /><br /><label for="largeur">Largeur image (max. 3000px)</label>: <input type="text" id="largeur" name="largeur" /><br /><label for="hauteur">Hauteur image (max. 3000px)</label>: <input type="text" id="hauteur" name="hauteur" /><br /><input type="submit" class="button" value="Valider" /></p></form>';
	show('filterUserFolder');
	show('boxUserFolder');
}
function desactive(elementid,elementid2,elementid3,elementid4){
	if(document.getElementById(elementid).disabled==true){
		document.getElementById(elementid).disabled = false;
	}
	else{
		document.getElementById(elementid).disabled = true;
		document.getElementById(elementid2).disabled = false;
		document.getElementById(elementid3).checked = false;
	}
}