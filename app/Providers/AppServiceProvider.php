<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();

        $company = DB::table('const')->whereIn('name', [
            'MAIN_INFO_OPENINGHOURS_FRIDAY',
            'MAIN_INFO_OPENINGHOURS_MONDAY',
            'MAIN_INFO_OPENINGHOURS_SATURDAY',
            'MAIN_INFO_OPENINGHOURS_THURSDAY',
            'MAIN_INFO_OPENINGHOURS_TUESDAY',
            'MAIN_INFO_OPENINGHOURS_WEDNESDAY',
            'MAIN_INFO_SIREN',
            'MAIN_INFO_SIRET',
            'MAIN_INFO_SOCIETE_ADDRESS',
            'MAIN_INFO_SOCIETE_COUNTRY',
            'MAIN_INFO_SOCIETE_FAX',
            'MAIN_INFO_SOCIETE_FORME_JURIDIQUE',
            'MAIN_INFO_SOCIETE_LOGO',
            'MAIN_INFO_SOCIETE_LOGO_MINI',
            'MAIN_INFO_SOCIETE_LOGO_SMALL',
            'MAIN_INFO_SOCIETE_LOGO_SQUARRED',
            'MAIN_INFO_SOCIETE_LOGO_SQUARRED_MINI',
            'MAIN_INFO_SOCIETE_LOGO_SQUARRED_SMALL',
            'MAIN_INFO_SOCIETE_MAIL',
            'MAIN_INFO_SOCIETE_MANAGERS',
            'MAIN_INFO_SOCIETE_NOM',
            'MAIN_INFO_SOCIETE_OBJECT',
            'MAIN_INFO_SOCIETE_STATE',
            'MAIN_INFO_SOCIETE_TEL',
            'MAIN_INFO_SOCIETE_TOWN',
            'MAIN_INFO_SOCIETE_WEB',
            'MAIN_INFO_SOCIETE_ZIP',
        ])->get();
        config(['company' => $company->map(function ($item) {
            return [$item->name => $item->value];
        })->collapse()]);
    }
}
