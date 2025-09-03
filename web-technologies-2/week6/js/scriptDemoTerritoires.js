
window.addEventListener('DOMContentLoaded', initPage);

/**
 *  init de la page (mise en place du gestionnaire d'évènements)
 */
function initPage(ev) {
    document.getElementById('bouton_afficher').addEventListener('click', majTerritoires);
}

/**
 * déclenche la mise à jour de la liste
 */
function majTerritoires() {
    fetchFromJson('services/getTerritoires.php')
        .then(processAnswer)
        .then(afficherTerritoires, erreurTerritoires);
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
 * vide les zone d'affichage de la table et affiche une liste de territoires
 * @param {*} tab : liste de territoires
 */
function afficherTerritoires(tab) {
    // récupérer les éléments à manipuler
    const liste = document.getElementById('liste_territoires');
    const message = document.getElementById('message');
    // effacer le contenu de ces deux éléments
    liste.replaceChildren();
    message.replaceChildren();
    // insérer les items
    for (let territoire of tab) {
        liste.appendChild(territoireToItem(territoire));
    }
}

/**
 * représentation d'un territoire dans un item (nom et identifiant)
 * @param {*} territoire 
 * @returns élément DOM <li>
 */
function territoireToItem(territoire) {
    const item = document.createElement('li');
    item.textContent = `${territoire.nom} (id:${territoire.id})`;
    return item;
}


function erreurTerritoires(e){
    document.getElementById('message').textContent = `Erreur : ${e.message}`;
}