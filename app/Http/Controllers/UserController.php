<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    protected $userService;
    protected $activityLogService;


    public function __construct(
        UserService $userService,
        ActivityLogService $activityLogService
    ) {

        $this->userService = $userService;

        $this->activityLogService = $activityLogService;


        $this->middleware('permission:view users')
            ->only([
                'index',
                'show'
            ]);


        $this->middleware('permission:manage users')
            ->except([
                'index',
                'show'
            ]);

    }





    /**
     * Display users
     */
    public function index()
    {

        $users = $this->userService->getAll();


        return view(
            'users.index',
            compact('users')
        );

    }







    /**
     * Create form
     */
    public function create()
    {

        $roles = Role::where(
            'guard_name',
            'web'
        )->get();



        return view(
            'users.create',
            compact('roles')
        );

    }







    /**
     * Store user
     */
    public function store(UserRequest $request)
    {

        DB::transaction(function () use ($request,&$user){


            $data = $request->validated();



            $role = $data['role'];



            unset($data['role']);



            $user = $this->userService->store($data);



            $user->assignRole($role);



            $this->activityLogService->store([

                'user_id' => auth()->id(),

                'module' => 'User',

                'activity' =>
                    'Menambahkan user "'.$user->name.'"',

                'ip_address'=>request()->ip(),

            ]);



        });



        return redirect()

            ->route('users.index')

            ->with(
                'success',
                'User berhasil ditambahkan.'
            );

    }







    /**
     * Show user detail
     */
    public function show(string $id)
    {

        $user = $this->userService
            ->getById($id);



        return view(
            'users.show',
            compact('user')
        );

    }







    /**
     * Edit form
     */
    public function edit(string $id)
    {

        $user = $this->userService
            ->getById($id);



        $roles = Role::where(
            'guard_name',
            'web'
        )->get();



        return view(
            'users.edit',
            compact(
                'user',
                'roles'
            )
        );

    }







    /**
     * Update user
     */
    public function update(
        UserRequest $request,
        string $id
    )
    {


        DB::transaction(function () use ($request,$id,&$user){


            $data = $request->validated();



            $role = $data['role'];



            unset($data['role']);



            if(empty($data['password'])){

                unset($data['password']);

            }




            $user = $this->userService
                ->update(
                    $id,
                    $data
                );



            $user->syncRoles($role);




            $this->activityLogService->store([


                'user_id'=>auth()->id(),

                'module'=>'User',

                'activity'=>
                    'Mengubah user "'.$user->name.'"',

                'ip_address'=>request()->ip(),


            ]);



        });



        return redirect()

            ->route('users.index')

            ->with(
                'success',
                'User berhasil diperbarui.'
            );

    }







    /**
     * Delete user
     */
    public function destroy(string $id)
    {


        $user = $this->userService
            ->getById($id);




        $this->activityLogService->store([


            'user_id'=>auth()->id(),

            'module'=>'User',

            'activity'=>
                'Menghapus user "'.$user->name.'"',

            'ip_address'=>request()->ip(),


        ]);




        $this->userService
            ->delete($id);




        return redirect()

            ->route('users.index')

            ->with(
                'success',
                'User berhasil dihapus.'
            );


    }

}