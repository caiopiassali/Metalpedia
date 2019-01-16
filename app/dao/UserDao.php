<?php
namespace app\dao;

use core\dao\Dao;
use app\model\UserModel;
use app\model\CityModel;
use app\dao\CityDao;
use core\dao\SqlObject;
use core\dao\Connection;

final class UserDao extends Dao
{

    //..constantes para mapear colunas da tabela do bd
    const COL_ID = 'id_user';
    const COL_NAME = 'name_user';
    const COL_GENDER = 'gender_user';
    const COL_AVATAR = 'avatar_user';
    const COL_TYPE = 'type_user';
    const COL_STATUS = 'status_user';
    const COL_EMAIL = 'email_user';
    const COL_PASSWORD = 'password_user';

    public function __construct(UserModel $model = null)
    {
        $this->model = is_null($model) ? new UserModel() : $model;
        $this->tableName = 'users'; //..nome da tabela
        $this->tableId = self::COL_ID; //..nome do campo de id
        $this->setColumns(); //..abstrato - deve ser codificado aqui!
    }

    //..pegar os dados do model (objeto) e criar um array...
    protected function setColumns()
    {
        $this->columns[self::COL_NAME] = $this->model->getNameUser();
        $this->columns[self::COL_GENDER] = $this->model->getGenderUser();
        $this->columns[self::COL_AVATAR] = $this->model->getAvatarUser();
        $this->columns[self::COL_TYPE] = $this->model->getTypeUser();
        $this->columns[self::COL_STATUS] = $this->model->getStatusUser();
        $this->columns[self::COL_EMAIL] = $this->model->getEmailUser();
        //..cria um hash md5 para armazenar a senha
        $this->columns[self::COL_PASSWORD] = \md5($this->model->getPasswordUser());
    }

    public function findById($id)
    {
        try {
            /* esse método executa um 'select * from ... '*/
            $data = parent::findById($id);
            if ($data) { //..se retornar valor, então...
                /*
                $userModel = new UserModel(
                    $data[$this->tableId],
                    $data[self::COL_NAME],
                    $data[self::COL_GENDER],
                    null, $data[self::COL_STATUS],
                    $data[self::COL_TYPE], $data[self::COL_EMAIL],
                    (new CityDao())->findById($data[self::COL_CITY])
                );*/

                /*Obs: a palavra self:: faz referência à classe e é usada para acessar atributos estáticos e/ou constantes */

                $userModel = new UserModel();
                $userModel->setId($data[$this->tableId]);
                //$userModel->setName($data['name_user']);
                $userModel->setNameUser($data[self::COL_NAME]);
                $userModel->setGenderUser($data[self::COL_GENDER]);
                $userModel->setAvatarUser($data[self::COL_AVATAR]);
                //$userModel->setPassword()
                $userModel->setTypeUser($data[self::COL_TYPE]);
                $userModel->setStatusUser($data[self::COL_STATUS]);
                $userModel->setEmailUser($data[self::COL_EMAIL]);
                return $userModel;
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function selectAll(
        $criteria = null,
        $orderBy = null,
        $groupBy = null,
        $limit = null,
        $offSet = null
    ) {
        try {
            $data = parent::selectAll(
                $criteria,
                $orderBy,
                $groupBy,
                $limit,
                $offSet
            );
            if ($data) {
                $arrayList = null;
                foreach ($data as $reg) {
                    $userModel = new UserModel(
                        $reg[$this->tableId],
                        $reg[self::COL_NAME],
                        $reg[self::COL_GENDER],
                        $reg[self::COL_AVATAR],
                        $reg[self::COL_TYPE],
                        $reg[self::COL_STATUS],
                        $reg[self::COL_EMAIL],
                        null
                    );
                    $arrayList[] = $userModel;
                }
                return $arrayList;
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


    /**
     * Busca um usuário por login e senha
     * @param string $login O email do usuário
     * @param string $pass A senha do usuário
     * @return UserModel
     */
    public function findForLogin($login, $pass)
    {
        try {
            $sqlObj = new SqlObject(Connection::getConnection());
            $criteria = self::COL_EMAIL . " = '{$login}' and ";
            $criteria .= self::COL_STATUS . " = 'A' and ";
            $criteria .= self::COL_PASSWORD . " = md5('{$pass}')";
            $user = $sqlObj->select($this->tableName, '*', $criteria);
            if ($user) {
                $user = $user[0]; //..pega a primeira posição do array
                return new UserModel(
                    $user[$this->tableId], //..id do usuário
                    $user[self::COL_NAME], //..nome
                    $user[self::COL_GENDER], //..gênero
                    $user[self::COL_AVATAR],
                    $user[self::COL_TYPE],
                    $user[self::COL_STATUS],
                    $user[self::COL_EMAIL],
                    null
                );
            } else
                return null;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Verifica se um determinado e-mail está cadastrado no banco de dados.
     * @param string $email O email usado para a busca
     * @return bool True se já estiver cadastrado e False caso não esteja cadastrado. 
     */
    public function emailExists($email){
        try{
            $sqlObj = new SqlObject(Connection::getConnection());
            $user = $sqlObj->select($this->tableName, '*', "email_user = '{$email}'");
            if($user)
                return true;
            else
                return false;
        } catch(\Exception $ex){
            throw $ex;
        }
    }

}