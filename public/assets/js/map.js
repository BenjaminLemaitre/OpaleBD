let coor = document.getElementById('coor');
let description = document.getElementById('description');
let coorHtml = coor.innerHTML;
let descHtml = description.innerHTML;
let centre = [46.630558, 1.85051];

console.log(descHtml);

const regex = /\[(.*?)\]/g;
let filtre;
const expo = [];
while (filtre = regex.exec(coorHtml)) {
    const transform = filtre[1].split(',');
    const numbers = transform.map(Number);
    expo.push(numbers)
}

const sub = [];
let filter;
while (filter = regex.exec(descHtml)) {
    const transforme = filter[1].split(',');
    const strings = transforme.map(String);
    sub.push(strings)
}


// création de la map
let map = L.map('map').setView(centre, 6);

// importation de l'image map
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20
}).addTo(map);

// // ajout du marqueur
// let marker = L.marker(manif).addTo(map);
console.log(expo[0]);

expo.forEach((element, index)=>{
    let marker = L.marker(element).addTo(map);
    let paragraph = '';
    sub[index].forEach(popup=>
        paragraph+=popup,
        )
    marker.bindPopup(`<h3>${paragraph}</h3>`)
})

// ajout d'un popup
// marker.bindPopup('<h3>Calais, FRANCE</h3> <p>Nom manif</p>');
