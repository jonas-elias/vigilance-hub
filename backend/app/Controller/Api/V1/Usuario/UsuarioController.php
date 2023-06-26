<?php

namespace App\Controller\Api\V1\Usuario;

use Hyperf\Di\Annotation\Inject;
use App\Api\V1\DB\Transaction\Transaction;
use App\Api\V1\Usuario\Admin\AdminPersistence;
use App\Api\V1\Usuario\Admin\Exception\AdminException;
use App\Api\V1\Usuario\Admin\Validation\AdminValidation;
use App\Api\V1\Usuario\Cliente\ClientePersistence;
use App\Api\V1\Usuario\Cliente\Exception\ClienteException;
use App\Api\V1\Usuario\Cliente\Validation\ClienteValidation;
use App\Api\V1\Usuario\Exception\UsuarioException;
use App\Api\V1\Usuario\UsuarioPersistence;
use App\Api\V1\Usuario\Validation\UsuarioValidation;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class UsuarioController
 */
class UsuarioController
{
    #[Inject]
    protected UsuarioValidation $usuarioValidation;

    #[Inject]
    protected AdminValidation $adminValidation;

    #[Inject]
    protected ClienteValidation $clienteValidation;

    #[Inject]
    protected UsuarioPersistence $usuarioPersistence;

    #[Inject]
    protected AdminPersistence $adminPersistence;

    #[Inject]
    protected ClientePersistence $clientePersistence;

    #[Inject]
    protected Transaction $transaction;

    /**
     * Method constructor
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Method to insert new user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array 
     */
    public function register(RequestInterface $request, ResponseInterface $response)
    {
        $inputs = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'senha' => $request->input('senha'),
            'isAdmin' => $request->input('isAdmin')
        ];
        try {
            $this->usuarioValidation->validate($inputs, 'insert');

            $this->transaction->beginTransaction();
            $userId = $this->usuarioPersistence->insertGetId($inputs);

            if ($inputs['isAdmin']) {
                $this->adminValidation->validate(['userId' => $userId], 'insert');
                $this->adminPersistence->insert($userId);
                $this->transaction->commit();
                return $response->json([
                    'success' => true,
                    'message' => 'Usuário inserido com sucesso.'
                ])->withStatus(201);
            }
            $this->clienteValidation->validate(['userId' => $userId], 'insert');
            $this->clientePersistence->insert($userId);
            $this->transaction->commit();

            return $response->json([
                'success' => true,
                'message' => 'Usuário inserido com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $in) {
            return $response->json(json_decode($in->getMessage()))->withStatus(422);
        } catch (UsuarioException $ue) {
            $this->transaction->rollBack();
            return $response->json($ue->getMessage())->withStatus(400);
        } catch (AdminException $ae) {
            $this->transaction->rollBack();
            return $response->json($ae->getMessage())->withStatus(400);
        } catch (ClienteException $ce) {
            $this->transaction->rollBack();
            return $response->json($ce->getMessage())->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            return $response->json(([
                'erros' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }

    /**
     * Method to update user
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return array  
     */
    public function update(RequestInterface $request, ResponseInterface $response, int $userId)
    {
        $inputs = [
            'nome' => $request->input('nome'),
            'email' => $request->input('email')
        ];
        try {
            $this->usuarioValidation->validate($inputs, 'update');

            $this->transaction->beginTransaction();
            $this->usuarioPersistence->update($inputs, $userId);
            $this->transaction->commit();

            return $response->json([
                'success' => true,
                'message' => 'Usuário alterado com sucesso.'
            ])->withStatus(201);
        } catch (\InvalidArgumentException $in) {
            return $response->json(json_decode($in->getMessage()))->withStatus(422);
        } catch (UsuarioException $ue) {
            $this->transaction->rollBack();
            return $response->json(([
                'erros' => $ue->getMessage()
            ]))->withStatus(400);
        } catch (\Throwable $th) {
            $this->transaction->rollBack();
            return $response->json(([
                'erros' => 'Ocorreu algum erro interno na aplicação.'
            ]))->withStatus(500);
        }
    }
}
