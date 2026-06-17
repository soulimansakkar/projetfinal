var produits = [];
var panier = [];

window.onload = function() {
    chargerProduits();
};

function chargerProduits() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'data/produits.json', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            produits = JSON.parse(xhr.responseText);
            afficherProduits('burgers');
        }
    };
    xhr.send();
}

function afficherProduits(categorie) {
    var liste = [];
    for (var i = 0; i < produits.length; i++) {
        if (produits[i].categorie === categorie) {
            liste.push(produits[i]);
        }
    }

    var html = '';
    if (liste.length === 0) {
        html = '<p>Aucun produit trouvé.</p>';
    }

    for (var i = 0; i < liste.length; i++) {
        var p = liste[i];
        html += '<div class="produit-card" onclick="ajouterAuPanier(' + p.id + ')">';
        html += '<img src="data/images/' + p.image + '" onerror="this.src=\'data/images/default.jpg\'">';
        html += '<p class="produit-nom">' + p.nom + '</p>';
        html += '<p class="produit-prix">' + p.prix.toFixed(2) + ' €</p>';
        html += '</div>';
    }

    document.getElementById('produits-liste').innerHTML = html;

    var btns = document.querySelectorAll('.cat-btn');
    for (var i = 0; i < btns.length; i++) {
        btns[i].classList.remove('actif');
        if (btns[i].getAttribute('data-cat') === categorie) {
            btns[i].classList.add('actif');
        }
    }
}

function ajouterAuPanier(id) {
    var produit = null;
    for (var i = 0; i < produits.length; i++) {
        if (produits[i].id === id) {
            produit = produits[i];
            break;
        }
    }
    if (produit === null) {
        return;
    }

    var trouve = false;
    for (var i = 0; i < panier.length; i++) {
        if (panier[i].id === id) {
            panier[i].qte = panier[i].qte + 1;
            trouve = true;
            break;
        }
    }

    if (!trouve) {
        panier.push({ id: produit.id, nom: produit.nom, prix: produit.prix, qte: 1 });
    }

    majAffichagePanier();
}

function supprimerItem(index) {
    panier.splice(index, 1);
    majAffichagePanier();
}

function viderPanier() {
    panier = [];
    majAffichagePanier();
}

function majAffichagePanier() {
    var total = 0;
    var html = '';

    for (var i = 0; i < panier.length; i++) {
        var item = panier[i];
        var sousTotal = item.prix * item.qte;
        total = total + sousTotal;
        html += '<div class="panier-ligne">';
        html += '<span>' + item.qte + 'x ' + item.nom + '</span>';
        html += '<span>' + sousTotal.toFixed(2) + ' €</span>';
        html += '<button onclick="supprimerItem(' + i + ')">✕</button>';
        html += '</div>';
    }

    document.getElementById('panier-contenu').innerHTML = html;
    document.getElementById('panier-total').textContent = 'Total : ' + total.toFixed(2) + ' €';

    var nb = 0;
    for (var i = 0; i < panier.length; i++) {
        nb = nb + panier[i].qte;
    }
    document.getElementById('nb-panier').textContent = nb;
}

function togglePanier() {
    var panel = document.getElementById('panier-panel');
    if (panel.style.display === 'none') {
        panel.style.display = 'block';
    } else {
        panel.style.display = 'none';
    }
}

function validerCommande() {
    if (panier.length === 0) {
        alert('Votre panier est vide !');
        return;
    }

    var num = document.getElementById('numero-client').value;
    if (!num || num < 1) {
        alert('Merci de saisir un numéro client');
        return;
    }

    var total = 0;
    for (var i = 0; i < panier.length; i++) {
        total = total + panier[i].prix * panier[i].qte;
    }

    var commande = {
        numero: parseInt(num, 10),
        articles: panier,
        total: total
    };

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../bloc2-backend/api.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var reponse = JSON.parse(xhr.responseText);
                alert('Commande passée ! ID: ' + reponse.id);
            } else {
                alert('Erreur lors de la commande');
            }
            panier = [];
            majAffichagePanier();
            document.getElementById('numero-client').value = '';
        }
    };
    xhr.send(JSON.stringify(commande));
}
