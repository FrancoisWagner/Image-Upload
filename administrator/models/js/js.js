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
	var content = document.getElementById('content');
	box.innerHTML = '<div id="filter"></div><div id="box"><div id="boxheader"><span id="boxtitle">Message</span><span id="boxclose"><a href="javascript:hide(\'filter\');javascript:hide(\'box\');">Fermer</a></span></div><div id="boxcontent">'+message+'</div></div>';
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
		xhr.open('POST','models/ajax.php',true);
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
		xhr.open('POST','models/ajax.php',true);
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
// Fonction permettant d'afficher une la miniature de l'image
//**************************************************************************
function showImage(dir,folder,name){
	var boxTitle = document.getElementById('boxtitle');
	var boxContent = document.getElementById('boxcontent');
	boxTitle.innerHTML = '';
	boxTitle.innerHTML = name;
	boxContent.innerHTML = '';
	boxContent.innerHTML = '<div class="imageHebergee"><a href="'+dir+folder+name+'" target="blank"><img src="'+dir+folder+'miniatures/moyennes/'+name+'" alt="" /></a></div>';
	show('filterUserFolder');
	show('boxUserFolder');
}
//**************************************************************************
// Fonction permettant d'afficher un mail
//**************************************************************************
function showMail(content){
	var boxTitle = document.getElementById('boxtitle');
	var boxContent = document.getElementById('boxcontent');
	boxTitle.innerHTML = '';
	boxTitle.innerHTML = 'Mail';
	boxContent.innerHTML = '';
	boxContent.innerHTML = content;
	show('filterUserFolder');
	show('boxUserFolder');
}
//**************************************************************************
// Fonction permettant de supprimer un utilisateur
//**************************************************************************
function deleteUser(id){
	BoiteDeConfirmation = confirm('Voulez-vous vraiment supprimer cette entrée ?');
	if(BoiteDeConfirmation == true){
		Data2Delete = id;
		var node = document.getElementById('user'+id);
		var parentNode = node.parentNode;
		var parentOfParentNode = parentNode.parentNode;
		parentOfParentNode.removeChild(parentNode);
		var xhr;
		if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
		else{
		    alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		    return;
		}
		xhr.open('POST','models/ajax.php',true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState < 4){
				var imageLoading = document.createElement('img');
				imageLoading.src = 'views/images/loading.gif';
				document.getElementById('users').appendChild(imageLoading);
			}
			else{
				if(xhr.status == 200){
					if(xhr.responseText != ''){
						document.getElementById('users').innerHTML = xhr.responseText;
					}
				}
				else{
					alert('Status != 200');
				}
		    }
		}
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		var data = 'deleteUser='+ escape(Data2Delete);
		xhr.send(data);
	}
	else{
		alert("Action annulée.");
	}
}
//**************************************************************************
// Fonction permettant de supprimer un mail
//**************************************************************************
function deleteMail(id){
	BoiteDeConfirmation = confirm('Voulez-vous vraiment supprimer cette entrée ?');
	if(BoiteDeConfirmation == true){
		Data2Delete = id;
		var node = document.getElementById('mail'+id);
		var parentNode = node.parentNode;
		var parentOfParentNode = parentNode.parentNode;
		parentOfParentNode.removeChild(parentNode);
		var xhr;
		if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
		else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
		else{
		    alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		    return;
		}
		xhr.open('POST','models/ajax.php',true);
		xhr.onreadystatechange = function(){
			if(xhr.readyState < 4){
				var imageLoading = document.createElement('img');
				imageLoading.src = 'views/images/loading.gif';
				document.getElementById('mails').appendChild(imageLoading);
			}
			else{
				if(xhr.status == 200){
					if(xhr.responseText != ''){
						document.getElementById('mails').innerHTML = xhr.responseText;
					}
				}
				else{
					alert('Status != 200');
				}
		    }
		}
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		var data = 'deleteMail='+ escape(Data2Delete);
		xhr.send(data);
	}
	else{
		alert("Action annulée.");
	}
}
//**************************************************************************
// Fonction permettant d'activer un compte
//**************************************************************************
function activation(login,activation){
	var node = document.getElementById('activation'+activation);
	var xhr;
	if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
	else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
	else{
		alert('JavaScript : votre navigateur ne supporte pas les objets XMLHttpRequest...');
		return;
	}
	xhr.open('POST','models/ajax.php',true);
	xhr.onreadystatechange = function(){
		if(xhr.readyState < 4){
			var imageLoading = document.createElement('img');
			imageLoading.src = 'views/images/loading.gif';
			node.appendChild(imageLoading);
		}
		else{
			if(xhr.status == 200){
				if(xhr.responseText != ''){
					node.innerHTML = xhr.responseText;
				}
			}
			else{
				alert('Status != 200');
			}
	    }
	}
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	var data = 'login='+ login + '&activation=' + activation;
	xhr.send(data);
}