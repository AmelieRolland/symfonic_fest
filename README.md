# SYMFONIC FEST - AMELIE ROLLAND

## Site pour un festival de musique

#### ORGANISATION DE LA BDD :

* une table ‘music genre’ et
* une table ‘country’ liées à
* une table ‘band register’ liée à
* une table ‘progday’ liée à
* une table day et à
* une table ‘scene’.

La table progday réunit donc : le groupe, la scene, le jour, l’heure.

### **Fonctionnalités du site** :

* Inscription client (RegistrationForm) : 
- vérification de la validité de l’email, unique, et des passwords (avec contraintes, et repeatedType - utilisation de components de la librairie Symfony)
- page d’accueil mise à jour personnalisée à l’utilisateur
- connexion : redirection selon le rôle grâce au token dans AppAuthenticator.

* Admin : enregistrement d’un nouveau groupe, avec une image principale et d’autres images multiples.
* Enregistrement d’une programmation, en sélectionnant un groupe, un jour, une heure, une scène, etc
* Installation du CRUD : je l’ai touché surtout pour régler des erreurs dû au builder qui s’est généré automatiquement (il cherchait à ajouter une programmation à l’inscription d’un nouveau groupe - j’ai mis un peu de temps à comprendre ça)
* EasyAdmin : je l’ai installé par curiosité, mais j’avais déjà construit mes formulaire d'inscription/enregistrement.
* Events subscriber : hasheur de mot de passe en envoi d’email à chaque inscription d’un nouvel utilisateur.

### **Affichage** : 
accueil : boucle sur la table ‘day’ avec l’image correspondant à chaque journée
Au clic sur l’image, on atterrit sur la page de programmation correspondant avec les détails (fiches des  groupes programmés)
Au clic sur chaque fiche de ces groupes, on atterrit sur la page ‘band’ avec les détails du groupe.
Ajouts de messages flash.
Petite gymnastique pour associer toutes ces données!

### **Fixtures** : 
J’ai fait quelques fixtures pour les tables qui ne contiennent que quelques éléments (les scènes par exemple) mais concernant le groupe ou la programmation j’ai préféré passer directement par la création d’un formulaire.
Pour la table ‘pays’, j’ai trouvé un fichier csv d’une table déjà existante, puis je l’ai parsé afin d’intégrer les données qui m'intéressaient dans ma bdd.

## Difficultés rencontrées: 

Je suis passée par des erreurs concernant mes relations de tables.
Pour la page ‘progday’, qui affiche les groupes qui jouent le jour sélectionné,  j’ai réalisé que si j’avais un groupe qui jouait deux fois le même jour (why not!) Il s'affichait deux fois. J’ai trouvé, grâce à un sujet stackoverflow un peu ancien, une méthode pour trier ces données avec un tableau directement sur la page twig. It works. Mais je pense qu’il y avait plus simple (passer par le repository par exemple avec un ‘SELECT DISTINCT’ ou quelque chose comme ça).
J’ai peu travaillé le front, l’union de twig et tailwind m’a été compliquée à prendre en main, mais j’ai voulu avoir un beau formulaire alors j’en ai trouvé un déjà codé avec les classes tailwind; j’ai eu beaucoup d’erreurs à ce moment là (impossible de logout dans mes souvenirs) à cause d’un token csrf non valide; j’ai mis du temps avant de me souvenir qu’il y avait un champs hidden prévu pour le token que je devais intégrer moi même dans le formulaire.

## Améliorations à apporter: 
J’aimerai travailler la partie front davantage, le manque de temps ne me l’a pas permis. J’aimerai mieux exploiter les events. Il y a beaucoup de fonctionnalités que j’aurai aimé travailler (l’option ‘se souvenir de moi’ par exemple), ainsi que la sécurité en général et l’affichage (éviter la page d’erreur ‘access denied’ si j’essaie d’entrer dans la partie admin par exemple).





