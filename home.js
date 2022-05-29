



addElement();

function addElement() {
  fetch('citta.php').then(onCitta).then(onJCitta);
}

function onCitta(response) {
  return response.json();
}

function onJCitta(json) {
  for(let i=0; i<json.length; i++) {
    const sez = document.createElement('section');
    const currentDiv = document.querySelector('.sezioni');
    currentDiv.appendChild(sez);
    }
    for(let i=0; i<json.length; i++){
      const img = document.createElement("img");
      img.src = json[i].img;
      img.classList.add("imgprim");
      const newDiv = document.createElement("div");
      const newTest = document.querySelectorAll('section');
      newTest[i].appendChild(img);
      newTest[i].appendChild(newDiv);
  
      }
      for(let i=0; i<json.length; i++) {

        const newH3 = document.createElement("h3");
        const newContent = document.createTextNode(json[i].titolo);
        newH3.appendChild(newContent);
        const newId = document.createElement("h3");
        const ContentId = document.createTextNode(json[i].id);
        newId.appendChild(ContentId);
        const newP = document.createElement("p");
        const newDesc = document.createTextNode(json[i].descrizione);
        newP.appendChild(newDesc);
        
        const newA = document.createElement("a");
        newA.href="pacchetti.php";
        newA.innerText=json[i].link;
        
        newId.classList.add('hidden');

        const newPosition = document.querySelectorAll('section div');
        newPosition[i].appendChild(newH3);
        newPosition[i].appendChild(newId);
        newPosition[i].appendChild(newP);
        newPosition[i].appendChild(newA);
        
      }

      
}

function openMenu(event) {
  const mobile=document.querySelector('#mobile');
  mobile.classList.remove('hidden');
  menu.classList.add('hidden');
  document.body.classList.add("no_scroll");

  const elimina = document.querySelector('.elimina');
  elimina.addEventListener('click', removeMenu);
}

function removeMenu(event) {
  const mobile =document.querySelector('#mobile');
  mobile.classList.add('hidden');
  menu.classList.remove('hidden');
  document.body.classList.remove("no_scroll");
}
const menu = document.querySelector('#menu');
menu.addEventListener('click',openMenu);

const searchbar = document.querySelector('#filter input[type = "text"]');
searchbar.addEventListener('keyup', evidenzia);

function evidenzia(e) {

    const searchString = e.currentTarget.value;
    const he = document.querySelectorAll("h3");
    const p = document.querySelectorAll(".sezioni section");

    let i;

    for(i=0; i<he.length; i++) {     
      const txt = he[i].textContent;
    if (txt.toUpperCase().indexOf(searchString.toUpperCase()) !== -1) {
        p[i].classList.remove("hidden");
        } else {
        p[i].classList.add("hidden");
        }
    }
}