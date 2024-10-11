<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Enregistrement des services si nécessaire
    }

    public function boot()
    {
        // Enregistre le panneau par défaut
        Filament::serving(function () {
            Filament::registerPanel(
                Panel::make()
                    ->id('default') // Identifiant du panneau
                    ->path('/admin') // Chemin d'accès
                    ->resources([
                        // Ajoute ici tes ressources
                        \App\Filament\Resources\ApiKeyResource::class, // Exemples de ressources
                    ])
            );

            // Définit le panneau par défaut
            Filament::setDefaultPanel('default');
            Filament::serving(function () {
                // Vérification des panneaux enregistrés
                dd(Filament::getPanels());
            });

        });
    }
}