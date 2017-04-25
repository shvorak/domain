<?php

namespace Domain\Plugins
{

    /**
     * Interface Story
     *
     * @package Domain\Message
     */
    interface Story
    {

        /**
         * Returns story identification string
         *
         * @return string
         */
        public function getStory() : string;

    }

}
