## Administration
* Ajouter un slider
* Modifier un slider
* Supprimer un slider
* Gestion des sliders
* Publication d'un slider
* Ajouter un slide
* Gestion des slides
* Modifier un slide
* Supprimer un slide
* Publication d'un slide
* Poid d'un slide


## Client
* Template pour afficher un slider via l'identifiant

## Dépendances
* GlobalBundle
* OWLSlider

## Installation
### Menu
```twig
ICI
```

### Fichier
* app/AppKernel.php
```php
new SliderBundle\SliderBundle(),
```
* app/config.yml
```yml
- { resource: "@SliderBundle/Resources/config/services.yml" }
```
* app/routing.yml
```yml
slider:
    resource: "@SliderBundle/Resources/config/routing.yml"
    prefix:   /
```
## Client
* Ajouter le dossier web/img/slider/slide/tmp
* Ajouter le dossier web/img/slider/slide/minitaure
* Design disponible dans le dossier Install