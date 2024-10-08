## Présentation du contexte

Vincent Parrot, fort de ses 15 années d'expérience dans la réparation automobile, a ouvert son propre garage à Toulouse en 2021.

Depuis 3 ans, il propose une large gamme de services: réparation de la carrosserie et de la mécanique des voitures ainsi que leur entretien régulier pour garantir leur performance et
leur sécurité. De plus, le Garage V. Parrot met en vente des véhicules d'occasion afin d'accroître son chiffre d'affaires.

Vincent Parrot considère son atelier comme un véritable lieu de confiance pour ses clients et leurs voitures doivent, selon lui, à tout prix être entre de bonnes mains.

Bien qu'il fournisse grâce à ses employés un service de qualité et personnalisé à chaque client, Vincent Parrot reconnaît qu'il doit être visible sur internet s'il veut se faire
définitivement une place parmi la concurrence. Il a donc contacté l’agence de création de sites web dont vous faites partie pour un premier devis, qu'il a accepté.

Vous aurez alors pour mission de créer une application web vitrine pour le Garage V. Parrot, en mettant en avant la qualité des services délivrés par cette récente entreprise.

## Fonctionnalités principales
- **Gestion des voitures d'occasion** : ajout, affichage et suppression de véhicules d'occasion.
- **Téléchargement d'images** : possibilité d'ajouter plusieurs images pour chaque voiture.
- **Affichage des véhicules** : chaque voiture est affichée avec ses caractéristiques (marque, modèle, prix, kilométrage, etc.) et ses images dans un carrousel.
- **Page d'administration** : accès restreint pour ajouter et supprimer des véhicules
- **Présenter les services** : l'administrateur a la posibilité de modifier les informations directements à partir de son espace admin.
- **Définir les horaires d'ouvertures** : l'administrateur a la posibilité de préciser quand le garage est ouvert, à partir de son espace.
- **Receuillir les témoignages clients** : les avis seront modérés par un employé pour éviter tout contenu inapproprié ou offensant.
- **Création de compte** : possibilité de créer un compte employé depuis la page admin et lui attribuer un rôle.

## Prérequis 

- **PHP >= 8.1**
- **HTML, CSS3, Javascript**
- **Bootstrap**
- **Composer**
- **Symfony CLI**
- **EasyAdmin4**
- **MySQL** 
- **MongoDB**

## Installation

1. Clonez le projet depuis le dépôt Git :

    ```bash
    git clone https://github.com/jordyvuong/projet-garage.git
    cd projet-garage
    ```

2. Installez les dépendances PHP via Composer :

    ```bash
    composer install
    ```

3. Configurez la base de données dans le fichier `.env` :

    ```bash
    DATABASE_URL="mysql://root:@127.0.0.1:8000/garage_db"
    ```

4. Créez la base de données et exécutez les migrations :

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```
5. Démarrer le serveur symfony :

   ```bash
   symfony server:start -d
   ```


## Annexes 

Lien du PPT : https://www.canva.com/design/DAGSj5xtuyc/Sdx_krXR5kVJArWT-TBfRQ/view?utm_content=DAGSj5xtuyc&utm_campaign=designshare&utm_medium=link&utm_source=editor
