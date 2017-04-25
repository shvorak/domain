<?php

namespace Domain\Handler\Providers
{

    interface HandlersProvider
    {

        public function register(Handlers $bus);

    }

}

