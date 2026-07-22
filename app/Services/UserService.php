<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;

class UserService
{

    protected $userRepository;




    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {

        $this->userRepository = $userRepository;

    }





    public function getAll()
    {

        return $this->userRepository
            ->getAll();

    }





    public function getById($id)
    {

        return $this->userRepository
            ->getById($id);

    }





    public function store(array $data)
    {

        return $this->userRepository
            ->store($data);

    }





    public function update($id, array $data)
    {


        if(
            isset($data['password'])
            &&
            empty($data['password'])
        ){

            unset($data['password']);

        }



        return $this->userRepository
            ->update(
                $id,
                $data
            );


    }





    public function delete($id)
    {

        return $this->userRepository
            ->delete($id);

    }


}