lightGallery(document.getElementById('lightgallery'));

function showHide() {
	let menu = document.getElementById('menu');
  menu.classList.toggle('hidden');
}

function myFunction() {
  let input, filter, box, div, h2, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  box = document.getElementById("myBOX");
  div = box.getElementsByClassName('article__box');

  for (i = 0; i < div.length; i++) {
    h2 = div[i].getElementsByTagName("h2")[0];
    txtValue = h2.textContent || h2.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      div[i].style.display = "";
    } else {
      div[i].style.display = "none";
    }
  }
}