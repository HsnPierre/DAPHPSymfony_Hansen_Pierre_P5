var container = document.getElementById('login');
container.style.display = 'none';

function Popup(){

	if(container.style.display == 'none'){
		container.style.display = 'block';
	} else {
		container.style.display = 'none';
	}
}
