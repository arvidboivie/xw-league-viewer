<?php

namespace Boivie\League\Controller;

class HomeController extends BaseController
{
    public function get($request, $response, $args)
    {
        $leagues = $this->container->get('settings')['sheets'];

        return $this->container['view']->render(
            $response,
            'home.html',
            ['leagues' => $leagues]
        );
    }

    private function sortGamesByDate($games)
    {
        // TODO: this will have to do until I implement Carbon and compare dates LOL
        return array_reverse($games);
    }
}
