let input = document.getElementById('rechercheInput');
let form = document.getElementById('rechercheForm');
let button = document.getElementById('rechercheButton');
let container = document.getElementById('resultat');

input.addEventListener('input', function() {
    const searchTerm = input.value;
    if(searchTerm=="") {
        container.innerHTML = ""
    }
    else {
        resultat(searchTerm)
    }
})

// form.addEventListener('submit', function() {
    
//     const searchTerm = input.value;
//     if(searchTerm=="") {
//         container.innerHTML = ""
//     }
//     else {
//         resultat(searchTerm)
//     }
// })

function resultat(searchTerm) {
    let url = "/recherche/resultat/" + searchTerm;

    fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        }
    })
    .then(function(response) {
        if (!response.ok) {
            throw new Error('La réponse n\'est pas ok')
        }
        return response.json();
    })
    .then(function(data) {
        container.innerHTML=data.view.content
    })
}