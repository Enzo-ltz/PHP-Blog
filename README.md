# TP3 : Blog sous Symfony

###### Vous retrouverez dans ce documents des réponses aux questions posées dans le sujet du TP3 à l'adresse: https://course.larget.fr/dim/php/tp/tp3/01-getting-started-with-symfony/

> ## Quelles sont les fonctionnalités principales du Symfony CLI ?

Le CLI permet de :

* Créer de nouveau projet (traditionnels ou des microservices, application console, API) :

  ```
   symfony new --full symfony_tp
  ```

* Utiliser les composants Symfony :

  ```
   symfony new symfony_tp
  ```

* Utiliser une demo de Symfony :

  ```
  symfony new my_project_name --demo
  ```

* Vérifier les fails de sécurités : 

  ```
  symfony check:security
  ```

* Créer des entitées facilement : 

  ```
  symfony console make:entity
  ```

* Et pleins d'autres commandes disponible en tapant : 

  ```
  symfony console
  ```

  

  # Doctrine 

  

  > ## Quelles relations existent entre les entités (Many To One/Many To Many/...) ? Faire un schéma de la base de données.

![image-20210301101808280](C:\Users\Enzo\AppData\Roaming\Typora\typora-user-images\image-20210301101808280.png)

* ManyToOne : User peut avoir plusieurs posts tandis qu'un post peut avoir un seul User 

* ManyToMany : User peut avoir plusieurs posts et un post peut avoir plusieurs User 

* OneToMany : User peut avoir un post tandis que qu'un post peut avoir plusieurs User

* OneToOne : User peut avoir un post et un post peut avoir un User

  > Ceci est bien entendu un exemple non représentatif du TP, dans notre cas nous avons uniquement des ManyToOne



> ## Expliquer ce qu'est le fichier .env

Le fichier .env est un fichier d'environnement du projet. Il contient les informations de connexion aux base de données, mais également des informations sur l'environnement technique de Symfony (soit en dev soit en prod).

> ## Expliquer pourquoi il faut changer le connecteur à la base de données

Nous devons changer de base de données puisque nous utilisons une base SQLite tandis que le projet est défini sur une base PostgreSQL à sa création.

> ## Expliquer l'intérêt des migrations d'une base de données

Les migrations permettent de créer facilement et rapidement une base de données selon les relations entrées dans le projet. Elles nous permettent de versionner nos base de données et de s'assurer que nos données sont sauvegarder. Ainsi, lorsque nous changeons le format d'une donnée, cela nous permet de ne pas tout casser !



# Administrations

> ## Faire une recherche sur les différentes solutions disponibles pour l'administration dans Symfony

Au cours des recherches j'ai pu trouver deux bundles différents : 

* SonataAdmin
* EasyAdmin

Nous allons utiliser EasyAdmin dans ce projet

> ## Travail préparatoire : Qu'est-ce que EasyAdmin ?

EasyAdmin est un générateur d'admin pour Symfony, il permet de générer un backend rapidement en évitant d'avoir à répéter les lignes de codes. Il existe des commandes pour créer les structures des classes rapidement, toujours dans l'optique d'être efficace.



