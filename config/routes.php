<?

// config/routes.php
use App\Controller\CountRedirectController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    
    $routes->add('count_and_redirect', "/{link_id}")
        ->controller([CountRedirectController::class, "countRedirect"]);
    
};

?>