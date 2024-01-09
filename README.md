# OC - p7

## Openclassrooms projet 7 (parcours : Développeur d'application - PHP/Symfony)

### Créez un web service exposant une API

## Codacy
### Here is the review of code by Codacy (on branch dev) :
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/b633a86fb7c94242987df46f23d6dc95)](https://app.codacy.com/gh/David-Renard/OC-p7/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

## Présentation du projet
### Contexte
__BileMo__ est une entreprise offrant toute une sélection de téléphones mobiles haut de gamme. Vous êtes en charge du 
développement de la vitrine de téléphones mobiles de l'entreprise _BileMo_. Le business modèle de _BileMo_ n'est pas de 
vendre directement ses produits sur le site web, mais de fournir à toutes les plateformes qui le souhaitent l'accès au 
catalogue via une API (Application Programming Interface). Il s'agit donc de vente exclusivement en B2B (business to 
business).
Il va falloir que vous exposiez un certain nombre d'API pour que les applications des autres plateformes web puissent 
effectuer des opérations.

### Besoins
Après une réunion dense avec le premier client de BileMo, il a identifié un certain nombre d'informations. Il doit être 
possible de :
* consulter la liste des produits BileMo;
* consulter les détails d'un produit BileMo;
* consulter la liste des utilisateurs inscrits liés à un client sur le site web;
* consulter le détail d'un utilisateur inscrit lié à un client;
* ajouter un nouvel utilisateur lié à un client;
* supprimer un utilisateur ajouté par un client.

## Installation
### Pré-requis
> Langages : PHP ^8.2.9, Symfony ^6.4.0

> Base de données : Postgres ^15.0

> Un WebServer

> Composer installé

1.  Clôner le répertoire (https://github.com/David-Renard/OC-p7.git)
2.  Copier le fichier .env en un fichier .env.local
3.  Dans la section __doctrine__ vous pouvez remplacer la ligne non commentée par :
`DATABASE_URL="postgresql://postgres:root@127.0.0.1:5432/MyApiBileMo?serverVersion=15&charset=utf8"`

__MyApiBileMo__ est le nom de la base de données que vous allez créer pour mettre en place le projet.

4.  Dans le dossier config à la racine du projet, ajouter un nouveau répertoire `jwt`.

5.  Générer une paire de clés pour la ocnfiguration du JWT en tappant :

* `winpty openssl genrsa -out config/jwt/private.pem -aes256 4096`
pour la génération de la clé privée. 

Cette commande vous demande une passphrase et sa vérification, prenez garde à vous souvenir de cette passphrase entrée 
ici.
* `openssl rsa -outform PEM -pubout -in config/jwt/private.pem -out config/jwt/public.pem` pour la génération de la clé 
publique.

Il vous est une nouvelle fois demandé de saisir la passphrase entrée précédemment.
De plus inscrivez cette passphrase dans votre fichier .env.local dans la section _lexiq_ pour l'attribut JWT_PASSPHRASE.
 
6.  Créer la base de données en tappant : `symfony console doctrine:database:create`
 
7.  Réaliser les migrations en tappant : `symfony console doctrine:migrations:migrate`
  
8.  Charger les fixtures en tappant : `symfony console doctrine:fixtures:load`

9.  Votre projet est maintenant prêt vous pouvez l'utiliser en tappant : `symfony serve -d` et en vous rendant à 
l'adresse http://127.0.0.1:8000/api/docs
10.  Voici le code json vous permettant d'accèder à l'api via `login_check` :
    `{
    "email": "dev@orange.fr",
    "password": "QnwXBoHu!q4qGe5"
    }`