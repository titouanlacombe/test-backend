
_On veut implémenter un système de caisse permettant 
le calcul du rendu de la monnaie_


## Démarrage du projet
Il suffit de démarrer docker
```
docker-compose up -d 
```

- Au démarrage du container le script ./back/run.sh.
Il exécute notamment : 
   - composer install
   - php artisan migrate
   - php artisan db:seed
- Après démarrage de docker
   - l'api Laravel est accessible sur http://localhost:8000

_NB: attention à Git sur Windows qui transforme parfois  les sauts de ligne  )
les sauts de ligne linux "\n" en saut de ligne Windows "\r\n" ce qui 
empeche l'exécution du script ./back/run.sh_
    
## Exercice

### But global de l'exercice
Le but est de créer un système de calcul de rendu de monnaie.
Il faut pouvoir via une API Rest
- Récupérer le contenu de la caisse
- Calculer le rendu de monnaie :
  - Input :
    - Le montant à régler
    - les pieces et billets utilisés pour payer
  - Retour
    - Les pièces et billets à rendre. 
  - Cela mettra à jour automatiquement le contenu de la caisse

NB : 
On prendra comme pièces et billets possibles : 1, 2, 5, 10, 20, 50, 100
On considera que tous les montants sont des entiers

### Lot 1
Faire une api REST qui permettra de récupérer le contenu de la caisse.
Le contenu de la caisse sera stocké dans SQL 
(utiliser les migrations et les seed Laravel si nécessaire).

### Lot 2
Créer l'api pour le rendu de monnaie, on pourra dans un premier temps
mocké le calcul du rendu de monnaie. 

### Lot 3 
Implémenter l'api pour le rendu de monnaie. 

## Tips
- Laravel dispose d'une ligne de commande puissante `php artisan`: 
   - permettant de créer simplement les principaux objets du framework : model, migration de base, seeder...
   - permettant de mettre à jour le cache
- Les routes dans Laravel sont configurées dans le dossier /routes




