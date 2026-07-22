<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    protected $model;



    public function __construct(User $user)
    {

        $this->model = $user;

    }





    public function getAll()
    {

        $query = $this->model
            ->with('roles');



        if(request()->filled('search'))
        {

            $search = request('search');


            $query->where(function($q) use ($search){

                $q->where(
                    'name',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'email',
                    'like',
                    "%{$search}%"
                );


            });


        }



        return $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

    }





    public function getById($id)
    {

        return $this->model
            ->with('roles')
            ->findOrFail($id);

    }





    public function store(array $data)
    {

        return $this->model
            ->create($data);

    }





    public function update($id, array $data)
    {

        $user = $this->getById($id);


        $user->update($data);


        return $user;

    }





    public function delete($id)
    {

        $user = $this->getById($id);


        return $user->delete();

    }

}