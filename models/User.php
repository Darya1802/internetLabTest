<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 *
 * @property-read mixed $id
 */
class User extends ActiveRecord
{
    public function rules(): array
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // email is validated by validateEmail()
            [['email'], 'email'],
            // username is string
            [['username'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}