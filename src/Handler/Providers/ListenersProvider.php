<?php

namespace Domain\Handler\Providers
{

    /**
     * Interface ListenersProvider
     *
     * @package Domain\Handler\Providers
     */
    interface ListenersProvider
    {

        public function register(Listeners $listeners);

    }

}

