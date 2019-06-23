<?php
use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

$app->post('/login', function (Request $request, Response $response, array $args) {
    $input = $request->getParsedBody();
    $email = $input['email'] ?? false;
    $senha = $input['senha'] ?? false;
    $dao = new DAO\PessoaDAO($this->db);
    $user = $dao->login($email)["data"];    
//    print_r($user);
//    return;
    if(!$user) {
        return $this->response->withJson(['error' => true, 'message' => 'E-mail não encontrado!']);  
    } 
    // verify password.
    if (!password_verify($senha,$user->getSenha())) {
        return $this->response->withJson(['error' => true, 'message' => 'Essas credenciais não correspondem aos nossos registros.']);  
    } 
    $settings = $this->get('settings');
    $this->session->setAll("ID_USUARIO", $user->getId());
    $this->session->setAll("ID_EMPRESA", $user->getEmpresa());
    $encode = ['ID_USUARIO' => $user->getId(), 'ID_EMPRESA' => $user->getEmpresa()];
    $token = JWT::encode($encode, $settings['jwt']['secret'], "HS256");
    $user->setToken($token);
    return $this->response->withJson($user);
});
$app->group('/registro', function(\Slim\App $app) {
});
$app->get('/verificar',function(Request $request, Response $response, array $args) {
    $params = $request->getServerParams();
    return $this->response->withJson([
        'api' => '/verificar',
        'sessions' => $this->session->getAll(), 
        'cookies' => $this->session->getAllCookie(),
        'params' => $params
    ]);
});
$app->group('/v2', function(\Slim\App $app) {
    $app->get('/perfil',function(Request $request, Response $response, array $args) {
        $dao = new \DAO\PessoaDAO($this->db);
        $perfil = $request->getAttribute('decoded_token_data');
        $retorno = [
            'api' => '/perfil', 
            'session' => $this->session->getAll(),
            'cookie' => $this->session->getAllCookie(), 
            'pessoa' => $dao->buscar($perfil["ID_USUARIO"]),
            'token_decode' => $perfil
        ];
        return $this->response->withJson($retorno);
    });
    $app->get('/logout',function(Request $request, Response $response, array $args) {
        $this->session->destroy();
        return $this->response->withJson([
            'api' => '/logout',
//            'cookie.params'=> session_get_cookie_params(),
            'sessions' => $this->session->getAll(), 
            'cookies' => $this->session->getAllCookie()
        ]);
    });
    // PESSOA
    $app->get('/pessoas',function(Request $request, Response $response, array $args) {
        $perfil = $request->getAttribute('decoded_token_data');
//        $input = $request->getParsedBody();
        $params = $request->getParams();
        
        $params['empresa'] = $perfil["ID_EMPRESA"];
        $dao = new \DAO\PessoaDAO($this->db);
        return $this->response->withJson($dao->listar($params));
    });
    $app->get('/pessoa',function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $pessoa = $input['id'] ?? NULL;
        $dao = new \DAO\PessoaDAO($this->db);
        return $this->response->withJson($dao->buscar($pessoa));
    });   
    $app->post('/pessoa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\PessoaDAO($this->db);
        return $this->response->withJson($dao->criar($input));
    });
    $app->put('/pessoa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\PessoaDAO($this->db);
        return $this->response->withJson($dao->editar($input));
    });
    $app->delete('/pessoa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\PessoaDAO($this->db);
        return $this->response->withJson($dao->deletar($input));
    });
    // VEICULO
    $app->get('/veiculos',function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $empresa = $input['empresa'] ?? NULL;
        $dao = new \DAO\VeiculoDAO($this->db);
        return $this->response->withJson($dao->listar($empresa));
    }); 
    $app->get('/veiculo',function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $veiculo = $input['id'] ?? NULL;
        $dao = new \DAO\VeiculoDAO($this->db);
        return $this->response->withJson($dao->buscar($veiculo));
    });
    $app->post('/veiculo', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\VeiculoDAO($this->db);
        return $this->response->withJson($dao->criar($input));
    });
    $app->put('/veiculo', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\VeiculoDAO($this->db);
        return $this->response->withJson($dao->editar($input));
    });
    $app->delete('/veiculo', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\VeiculoDAO($this->db);
        return $this->response->withJson($dao->deletar($input));
    });
    // EMPRESA
    $app->get('/empresas',function(Request $request, Response $response, array $args) {
        $dao = new \DAO\EmpresaDAO($this->db);
        return $this->response->withJson($dao->listar());
    }); 
    $app->get('/empresa',function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $empresa = $input['id'] ?? NULL;
        $dao = new \DAO\EmpresaDAO($this->db);
        return $this->response->withJson($dao->buscar($empresa));
    });
    $app->post('/empresa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\EmpresaDAO($this->db);
        return $this->response->withJson($dao->criar($input));
    });
    $app->put('/empresa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\EmpresaDAO($this->db);
        return $this->response->withJson($dao->editar($input));
    });
    $app->delete('/empresa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\EmpresaDAO($this->db);
        return $this->response->withJson($dao->deletar($input));
    });
    // ROTA
    $app->get('/rotas',function(Request $request, Response $response, array $args) {
        $dao = new \DAO\RotaDAO($this->db);
        return $this->response->withJson($dao->listar());
    }); 
    $app->get('/rota',function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $rota = $input['id'] ?? NULL;
        $dao = new \DAO\RotaDAO($this->db);
        return $this->response->withJson($dao->buscar($rota));
    });
    $app->post('/rota', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\RotaDAO($this->db);
        return $this->response->withJson($dao->criar($input));
    });
    $app->put('/rota', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\RotaDAO($this->db);
        return $this->response->withJson($dao->editar($input));
    });
    $app->delete('/rota', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\RotaDAO($this->db);
        return $this->response->withJson($dao->deletar($input));
    });
    // ROTA_PESSOA
    $app->get('/rotas/pessoas',function(Request $request, Response $response, array $args) {
        $dao = new \DAO\RotaPessoaDAO($this->db);
        return $this->response->withJson($dao->listar());
    }); 
    $app->get('/rota/pessoa',function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $rotapessoa = $input['id'] ?? NULL;
        $dao = new \DAO\RotaPessoaDAO($this->db);
        return $this->response->withJson($dao->buscar($rotapessoa));
    });
    $app->post('/rota/pessoa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\RotaPessoaDAO($this->db);
        return $this->response->withJson($dao->criar($input));
    });
    $app->put('/rota/pessoa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\RotaPessoaDAO($this->db);
        return $this->response->withJson($dao->editar($input));
    });
    $app->delete('/rota/pessoa', function(Request $request, Response $response, array $args) {
        $input = $request->getParsedBody();
        $dao = new DAO\RotaPessoaDAO($this->db);
        return $this->response->withJson($dao->deletar($input));
    });
});
$app->get('/cidades',function(Request $request, Response $response, array $args) {
    $input = $request->getParsedBody();
    $estado = $input['estado'] ?? NULL;
    $dao = new \DAO\CidadeDAO($this->db);
    return $this->response->withJson($dao->listar($estado));
});
$app->get('/cidade/{id}',function(Request $request, Response $response, array $args) {
//    $input = $request->getParsedBody();
    $dao = new \DAO\CidadeDAO($this->db);
    $cidade = $args['id'] ?? NULL;
    return $this->response->withJson($dao->buscar($cidade));
});