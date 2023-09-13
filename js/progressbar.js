let form = document.querySelector('#formSubir');
form.addEventListener('submit',function() {
	let inputFile = document.querySelector('#inputFile').files[0];
	let progressbar = document.querySelector('#progressBar');

	let formdata = new FormData();
	formdata.append("inputFile",inputFile);
	let ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress",function(e) {
		let porcentaje = (e.loaded / e.total) * 100;
		progressbar.value = Math.round(porcentaje);	
	});

	ajax.open("POST","../admin/fotosInsertar.php");
	ajax.send(formdata);
});