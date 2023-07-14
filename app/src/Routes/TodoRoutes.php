<?php declare(strict_types=1);

namespace App\Routes;



/**
 * Роуты модуля контентных страниц.
 */
class PageRoutes
{
    public static function register(): void
    {
        Route::view('/about', 'page.about')->name('about');
        Route::view('/adverting', 'page.adverting')->name('adverting');
        Route::view('/agreements', 'page.agreements')->name('agreements');
        Route::view('/cooperation', 'page.cooperation')->name('cooperation');
        Route::view('/exhibition', 'page.exhibition')->name('exhibition');
//        Route::view('/partners', 'page.partners')->name('partners');
        Route::view('/promo', 'page.promo')->name('promo');
        Route::view('/rules', 'page.rules')->name('rules');
    }
}