pacchetti();
function pacchetti() {
    fetch('pacchettiapi.php').then(onResponse).then(onJson);
}

function onJson(json) {
    console.log(json);    

    for(j of json) {
        const cart=document.createElement('div');
        const div=document.createElement('div');
        const div1=document.createElement('div');
        const utility=document.createElement('div');
        div1.classList.add('tragitto');
        utility.classList.add('utility');
        const pacchettiid=document.createElement('div');
        const tra =document.createElement('div');
        const viaggio = document.createElement('h5');
        const orario=document.createElement('div');
        
        const partenza = document.createElement('h5');
        const day=document.createElement('h5');
        const button = document.createElement('button');
        const info = document.createElement('div');
        const price = document.createElement('h5');
        info.classList.add('info');
        div.classList.add('total');
        orario.classList.add('orario');
        div.style.display = 'none';
        button.innerHTML='Rimuovi';
        viaggio.textContent = ' Tuor All-inclusive  ' + j.destinazione_tour;
        partenza.textContent = ' partenza ore: ' + j.ora_partenza;
        
        day.textContent = 'Giorno ' + j.giorno;
        price.textContent = 'Prezzo ' + j.prezzo + '€';
        pacchettiid.textContent= j.id;
        tra.appendChild(viaggio);
        div1.appendChild(tra);
        orario.appendChild(partenza);
        
        utility.appendChild(div1);
        info.appendChild(day);
        info.appendChild(price);
        utility.appendChild(orario);
        utility.appendChild(info);
        div.appendChild(utility);
        div.appendChild(button);    
        cart.appendChild(pacchettiid);
        div.appendChild(cart);
        cont.appendChild(div);
        pacchettiid.classList.add('hidden');
        
        
        button.addEventListener('click',Remove);
        fetch('cartapi.php?q='+j.id).then(CartResp).then(CartJson);
            


    }
}

function onResponse(response) {
    console.log(response);
    return response.json();
}


function Remove(event) {
    const pacchetti = event.currentTarget.parentNode.querySelector('.hidden').textContent;
    console.log(pacchetti);
    fetch('removecart.php?q='+pacchetti);
    window.location.reload();
    

}


function CartResp(response) {
    return response.json();
}




function CartJson(json) {

    console.log(json);
    const quant = document.createElement('div');
    quant.classList.add('quantity');
    const es=document.querySelectorAll('.hidden');
    for(let i=0; i<es.length; i++) {
        for(j of json) {
            if(es[i].textContent == j.pacchetti_c) {
                quant.textContent = 'quantità: ' + j.quantita; 
                es[i].parentNode.appendChild(quant);
                es[i].parentNode.parentNode.style.display='flex';
            }
        }
    }
}


const cont=document.querySelector('.container');

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