<?php

namespace Boivie\League\Controller;

class HomeController extends BaseController
{
    public function get($request, $response, $args)
    {
        $leagues = $this->container->get('settings')['leagues'];

        return $this->container['view']->render(
            $response,
            'home.html',
            ['leagues' => $leagues]
        );
    }
}
