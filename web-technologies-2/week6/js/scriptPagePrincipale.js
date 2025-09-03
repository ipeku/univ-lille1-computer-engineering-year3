

window.addEventListener('load', initPage);



/**
 *  init de la page 
 */
function initPage() {
    // chargement de la liste d'options (territoires proposés)
    majOptionsTerritoires();
    // gestion de la validation du formulaire
    document.forms.form_communes.addEventListener("submit", sendForm); 

    // centrage de la carte géographique sur le territoire courant
    document.forms.form_communes.territoire.addEventListener("change", function () {
        centerMapElt(this[this.selectedIndex]);
    });
}

/**
 * extrait le  résultat du service de l'objet "meta" Answer
 * @param {*} answer  (objet "meta" Answer reçu du service)
 * @returns résultat du service
 * @throws Error en cas de problème
 */
function processAnswer(answer) {
    if (answer.status == "ok")
        return answer.result;
    else
        throw new Error(answer.message);
}

/**
 * déclenche la mise à jour des options
 */
function majOptionsTerritoires() {
    fetchFromJson('services/getTerritoires.php')
        .then(processAnswer)
        .then(makeOptions);
}

/**
 * Création de la liste des options du <select>
 * @param {*} tab  : liste de territoires
 */
function makeOptions(tab) {
    const select_elt = document.forms.form_communes.territoire; // chanmp de saisie de name territoires dans le formulaire form_communes 
    select_elt.replaceChildren(new Option("Tous", "")); // vide et indère une première option <option value="">Tous</option>
    for (let territoire of tab) {
        const option = new Option(territoire.nom, territoire.id);
        select_elt.appendChild(option);
        // ajouter les geo coord à l'élément option, dans des attributs data-
        for (let k of ['min_lat', 'min_lon', 'max_lat', 'max_lon']) {
            option.dataset[k] = territoire[k];
        }
    }
}

/**
 * Gestionnaire évènement "submit" sur le formulaire
 * déclenche la mise à jour de la liste des communes
 * @param {*} ev : évènement géré
 */
function sendForm(ev) { // form event listener
    ev.preventDefault();
    const parms = new FormData(ev.target);

    fetchFromJson('services/getCommunes.php', {
        method: 'POST',
        body: parms
    })
        .then(processAnswer)
        .then(makeCommunesItems);
}

/**
 * affiche une liste de communes dans la liste liste_communes
 * @param {*} tab : liste des communes à afficher
 */
function makeCommunesItems(tab) {
    const ul = document.getElementById('liste_communes')
    ul.replaceChildren();

    for (let commune of tab) {
        const li = document.createElement('li');
        li.textContent = commune.nom;

        for (let k of ['insee', 'lat', 'lon', 'min_lat', 'min_lon', 'max_lat', 'max_lon']) {
            li.dataset[k] = commune[k];
        }

        const handleMouseOver = () => centerMapElt(li);
        li.addEventListener('mouseover', handleMouseOver);


        li.addEventListener('click', fetchDisplayCommune);
        //Je n'ai pas pu faire de commit directement depuis ma machine locale cette fois, j'ai reçu une erreur 
        //donc j'ai copié ce que j'ai fait localement ici. 
        //Du coup, j'ai oublié de supprimer cette ligne quand j'ai poussé la question 3. 
        //Elle aurait dû être ajoutée dans cette question.

        ul.appendChild(li);
    }
}


/**
 * Centre la carte sur les limites géographiques portées par l'élément
 * @param {*} elt un élément DOM dont le dataset doit posséder les 4 attributs : min_lat, min_lon, max_lat, max_lon
 */
function centerMapElt(elt) {
    let ds = elt.dataset;
    map.fitBounds([[ds.min_lat, ds.min_lon], [ds.max_lat, ds.max_lon]]);
}

function displayCommune(commune) {
    const div_details = document.getElementById("details");
    div_details.innerHTML = '';
    const ul = document.createElement("ul");
    createDetailMap(commune);
    for (let k of ['insee', 'nom', 'nom_terr', 'lat', 'lon', 'surface', 'perimetre', 'pop2016']) {
        const li = document.createElement("li");
        li.textContent = `${k}: ${commune[k]}`;
        ul.appendChild(li);
    }

    div_details.appendChild(ul);

}

// J'ai modifié le nom de la fonction car JavaScript ne supporte pas la surcharge de fonctions
function fetchDisplayCommune() {
    const insee = this.dataset['insee'];
    const parms = new URLSearchParams({insee: insee});

    fetchFromJson('services/getDetails.php', {
        method: 'POST',
        body: parms
    })
        .then(processAnswer)
        .then(displayCommune)
}