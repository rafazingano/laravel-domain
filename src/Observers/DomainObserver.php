<?php

namespace ConfrariaWeb\Domain\Observers;

use ConfrariaWeb\Domain\Models\Domain;
use Illuminate\Support\Facades\Auth;

class DomainObserver
{

    public function creating(Domain $domain)
    {
        $domain->setAttribute('user_id', Auth::id());
    }

    /**
     * Handle the domain "created" event.
     *
     * @param  \ConfrariaWeb\Domain\Models\Domain  $domain
     * @return void
     */
    public function created(Domain $domain)
    {
        //
    }

    /**
     * Handle the domain "updated" event.
     *
     * @param  \ConfrariaWeb\Domain\Models\Domain  $domain
     * @return void
     */
    public function updated(Domain $domain)
    {
        //
    }

    /**
     * Handle the domain "deleted" event.
     *
     * @param  \ConfrariaWeb\Domain\Models\Domain  $domain
     * @return void
     */
    public function deleted(Domain $domain)
    {
        //
    }

    /**
     * Handle the domain "restored" event.
     *
     * @param  \ConfrariaWeb\Domain\Models\Domain  $domain
     * @return void
     */
    public function restored(Domain $domain)
    {
        //
    }

    /**
     * Handle the domain "force deleted" event.
     *
     * @param  \ConfrariaWeb\Domain\Models\Domain  $domain
     * @return void
     */
    public function forceDeleted(Domain $domain)
    {
        //
    }
}
