<?php
namespace app\model;

use core\mvc\Model;
use app\model\CityModel;

final class UserModel extends Model
{

    private $name_user;
    private $gender_user;
    private $avatar_user;
    private $type_user;
    private $status_user;
    private $email_user;
    private $password_user;

    /**
     * UserModel constructor.
     * @param $name_user
     * @param $gender_user
     * @param $avatar_user
     * @param $type_user
     * @param $status_user
     * @param $email_user
     * @param $password_user
     */
    public function __construct(
        $id = null,
        $name_user = null,
        $gender_user = null,
        $avatar_user = null,
        $type_user = null,
        $status_user = null,
        $email_user = null,
        $password_user = null
    )
    {
        parent::__construct($id);
        $this->name_user = $name_user;
        $this->gender_user = $gender_user;
        $this->avatar_user = $avatar_user;
        $this->type_user = $type_user;
        $this->status_user = $status_user;
        $this->email_user = $email_user;
        $this->password_user = $password_user;
    }

    /**
     * @return null
     */
    public function getNameUser()
    {
        return $this->name_user;
    }

    /**
     * @param null $name_user
     */
    public function setNameUser($name_user)
    {
        $this->name_user = $name_user;
    }

    /**
     * @return null
     */
    public function getGenderUser()
    {
        return $this->gender_user;
    }

    /**
     * @param null $gender_user
     */
    public function setGenderUser($gender_user)
    {
        $this->gender_user = $gender_user;
    }

    /**
     * @return null
     */
    public function getAvatarUser()
    {
        return $this->avatar_user;
    }

    /**
     * @param null $avatar_user
     */
    public function setAvatarUser($avatar_user)
    {
        $this->avatar_user = $avatar_user;
    }

    /**
     * @return null
     */
    public function getTypeUser()
    {
        return $this->type_user;
    }

    /**
     * @param null $type_user
     */
    public function setTypeUser($type_user)
    {
        $this->type_user = $type_user;
    }

    /**
     * @return null
     */
    public function getStatusUser()
    {
        return $this->status_user;
    }

    /**
     * @param null $status_user
     */
    public function setStatusUser($status_user)
    {
        $this->status_user = $status_user;
    }

    /**
     * @return null
     */
    public function getEmailUser()
    {
        return $this->email_user;
    }

    /**
     * @param null $email_user
     */
    public function setEmailUser($email_user)
    {
        $this->email_user = $email_user;
    }

    /**
     * @return null
     */
    public function getPasswordUser()
    {
        return $this->password_user;
    }

    /**
     * @param null $password_user
     */
    public function setPasswordUser($password_user)
    {
        $this->password_user = $password_user;
    }

    public function getFullTypeUser() {
        switch ($this->type_user) {
            case 'U':
                return 'Usuário';
            case 'M':
                return 'Moderador';
            case 'A':
                return 'Administrador';
        }
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}