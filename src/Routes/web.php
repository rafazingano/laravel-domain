<?php
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')
    ->name('dashboard.')
    ->middleware(['web', 'auth'])
    ->namespace('ConfrariaWeb\Domain\Controllers')
    ->group(function () {
        Route::prefix('domains')
            ->name('domains.')
            ->group(function () {
                Route::get('datatable', 'DomainController@datatables')->name('datatables');

                Route::get('{domain}/dns/datatable', 'DomainDnsController@datatables')->name('dns.datatables');
                Route::get('{domain}/dns', 'DomainDnsController@index')->name('dns.index');
                Route::get('{domain}/dns/create', 'DomainDnsController@create')->name('dns.create');
                Route::post('{domain}/dns/store', 'DomainDnsController@store')->name('dns.store');
                Route::get('{domain}/dns/{id}/edit', 'DomainDnsController@edit')->name('dns.edit');
                Route::put('{domain}/dns/{id}', 'DomainDnsController@update')->name('dns.update');
                Route::delete('{domain}/dns/{id}', 'DomainDnsController@destroy')->name('dns.destroy');

            });
        Route::resource('domains', 'DomainController');
    });
