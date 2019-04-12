<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Master\Role;
use App\Service\Master\RoleService;

class MasterUserController extends Controller
{
    const URL       = 'master-user';
    const RESOURCE  = 'Master User';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'view'])) {
            abort('403');
        }

        if ($request->isMethod('post')) {
            $request->session()->put('filters', $request->all());
            return redirect(self::URL.'?page=1');
        } elseif (empty($request->get('page'))) {
            $request->session()->forget('filters');
        }
        $filters = $request->session()->get('filters');
        $query = \DB::table('users')
                    ->select('users.*', 'mst_role.role_name')
                    ->join('mst_role', 'mst_role.role_id', '=', 'users.role_id')
                    ->orderBy('name');

        if (!empty($filters['isActive']) || !$request->session()->has('filters')) {
            $query->where('users.is_active', '=', true);
        } else {
            $query->where('users.is_active', '=', false);
        }

        if (!empty($filters['name'])) {
            $query->where('users.name', 'like', '%'.$filters['name'].'%');
        }

        if (!empty($filters['username'])) {
            $query->where('users.username', 'like', '%'.$filters['username'].'%');
        }

        if (!empty($filters['email'])) {
            $query->where('users.email', 'like', '%'.$filters['email'].'%');
        }

        if (!empty($filters['role'])) {
            $query->where('users.role_id', 'like', '%'.$filters['role'].'%');
        }

        return view('master/master-user.index',[
            "models"        => $query->paginate(10),
            "filters"       => $filters,
            "roleOptions"   => RoleService::getActiveRole(),
            "url"           => self::URL,
            "resource"      => self::RESOURCE,
        ]);
    }

    public function add(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'add'])) {
            abort('403');
        } 

        $model              = new User();
        $model->is_active   = true;
        
        return view('master/master-user.add',[
            "model"         => $model,
            "roleOptions"   => RoleService::getActiveRole(),
        ]);

    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        }  

        $model = User::find($id);

        return view('master/master-user.add',[
            "model"         => $model,
            "roleOptions"   => RoleService::getActiveRole(),
        ]);
    }

    public function save(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'add']) && !\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $id     = intval($request->get('id'));
        
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'username' => 'required|max:200|unique:users,username,'.$id.',id',
            'role'     => 'required',
        ]);

        if(empty($id)){
            $this->validate($request, [
                'password' => 'required|string|min:6',
            ]);
            $model                  = new User();
        }else{
            $model                  = User::find($id);
        }

        $model->name        = $request->get('name');
        $model->username    = $request->get('username');
        $model->email       = $request->get('email');
        $model->role_id     = $request->get('role');
        $model->is_active   = !empty($request->get('isActive')) ? true : false;
        $model->is_super_admin = !empty($request->get('isSuperAdmin')) ? true : false;
        
        if(!empty($request->get('password'))){
            $model->password    = bcrypt($request->get('password'));
        }

        $now = new \DateTime();

        $foto = $request->file('foto');
        if ($foto !== null) {
            $fotoName   = md5($now->format('YmdHis')) . "." . $foto->guessExtension();
            $model->foto = $fotoName;
        }

        if ($foto !== null) {
            $foto->move(\Config::get('app.paths.foto-user'), $fotoName);
        }

        $model->save();

        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.master-user').' '.$model->name])
            );

        return redirect(route('master-user-index'));
    }
}
