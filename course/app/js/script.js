lightGallery(document.getElementById('lightgallery'));

function showHide() {
	let menu = document.getElementById('menu');
  menu.classList.toggle('hidden');
}

function filterList() {
  let input, filter, box, div, search, i, txtValue;
  input = document.getElementById('input');
  filter = input.value.toUpperCase();
  box = document.getElementById("article");
  div = box.getElementsByClassName('article__box');

  for (i = 0; i < div.length; i++) {
    search = div[i].getElementsByClassName("search")[0];
    txtValue = search.textContent || search.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      div[i].style.display = "";
    } else {
      div[i].style.display = "none";
    }
  }
}