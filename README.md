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
{% set menuSlider = ['admin_slider_manager', 'admin_slider_ajouter', 'admin_slider_modifier','admin_sliderslide_manager', 'admin_sliderslide_ajouter', 'admin_sliderslide_modifier'] %}
<a href="#" data-nav="slider-menu" class="menuNav {{ getCurrentMenu(menuSlider) }}"> <i class="fa fa-sliders"></i> Sliders <i class="fa fa-angle-right"></i></a>
<ul class="slider-menu {{ getCurrentMenu(menuSlider) }}">
    <li class="{{ getCurrentMenu(['admin_slider_ajouter']) }}"><a href="{{ path('admin_slider_ajouter')}}">Ajouter un slider</a></li>
    <li class="{{ getCurrentMenu(['admin_slider_manager']) }}"><a href="{{ path('admin_slider_manager')}}">Gestion des sliders</a></li>
</ul>
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
* JS disponible dans le dossier Install