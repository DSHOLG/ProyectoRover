function getNombreArchivoConExtensionSinRuta(text){
	return text.split(".")[0] + "." + text.split(".")[1].replace(/^.∗\//, "");
}
let inputFile = document.querySelector('#inputFile');
inputFile.addEventListener('change', function(){
let files = this.files;
	let text = "";
	for (let i = 0; i < files.length; i++){
		if (files[i].name){
			text += getNombreArchivoConExtensionSinRuta(files[i].name) + ", ";
		}
	}
	text = text.slice(0, -2);
	document.getElementById("fileText").value = text;
});