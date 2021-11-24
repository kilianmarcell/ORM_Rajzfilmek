<?php

// src/routes.php

use Petrik\Rajzfilmek\Rajzfilm;
use Petrik\Rajzfilmek\Nevek;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(Slim\App $app) {
    $app->get('/rajzfilmek', function(Request $request, Response $response) {
        $rajzfilmek = Rajzfilm::all();
        $kimenet = $rajzfilmek->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/rajzfilmek', function(Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        $rajzfilm = Rajzfilm::create($input);

        $kimenet = $rajzfilm->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201) // "Created" status code
            ->withHeader('Content-Type', 'application/json');
    });

    $app->delete('/rajzfilmek/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $rajzfilm = Rajzfilm::find($args['id']);
            if ($rajzfilm === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $rajzfilm->delete();
            return $response
                ->withStatus(204);
        });

        $app->put('/rajzfilmek/{id}', function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $rajzfilm = Rajzfilm::find($args['id']);
            if ($rajzfilm === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(), true);
            $rajzfilm->fill($input);
            $rajzfilm->save();
            $response->getBody()->write($rajzfilm->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });

        $app->get('/rajzfilmek/{id}', function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $rajzfilm = Rajzfilm::find($args['id']);
            if ($rajzfilm === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });
        

        $app->get('/nevek', function(Request $request, Response $response) {
            $nevek = Nevek::all();
            $kimenet = $nevek->toJson();
    
            $response->getBody()->write($kimenet);
            return $response->withHeader('Content-Type', 'application/json');
        });
    
        $app->post('/nevek', function(Request $request, Response $response) {
            $input = json_decode($request->getBody(), true);
            $nevek = Nevek::create($input);
    
            $kimenet = $nevek->toJson();
            
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201) // "Created" status code
                ->withHeader('Content-Type', 'application/json');
        });
    
        $app->delete('/nevek/{id}',
            function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $nevek = Nevek::find($args['id']);
                if ($nevek === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $nevek->delete();
                return $response
                    ->withStatus(204);
            });
    
            $app->put('/nevek/{id}', function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $nevek = Nevek::find($args['id']);
                if ($nevek === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $input = json_decode($request->getBody(), true);
                $nevek->fill($input);
                $nevek->save();
                $response->getBody()->write($nevek->toJson());
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            });
    
            $app->get('/nevek/{id}', function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $nevek = Nevek::find($args['id']);
                if ($nevek === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jű rajzfilm']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $response->getBody()->write($nevek->toJson());
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            });
};
