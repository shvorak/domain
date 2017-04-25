<?php

namespace Domain\Handler\Providers
{

    interface ListenersProvider
    {

        public function register(Listeners $listeners);

    }

}

