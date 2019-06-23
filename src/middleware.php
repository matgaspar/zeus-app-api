<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
$app->add(new \Tuupola\Middleware\JwtAuthentication([
    "secure" => false,
    "path" => ["/v2", "/admin", "/perfil"], /* or ["/api", "/admin"] */
    "attribute" => "decoded_token_data",
    "secret" => "supersecretkeyyoushouldnotcommittogithub",
    "algorithm" => ["HS256"],
    "error" => function ($response, $arguments) {
        $data["error"] = true;
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));

$app->add(function (Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response, callable $next) {
    // Use the PSR 7 $response object
    return $next($request, $response);
});

// Session middleware
$app->add(function ($request, $response, $next) {
    /* @var Container $this */
    $session = $this->get('session');
    $session->start();
    $response = $next($request, $response);
    return $response;
});