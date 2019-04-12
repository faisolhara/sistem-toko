<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Role;
use App\Model\Master\AccessControl;

class MasterRoleController extends Controller
{
    const URL       = 'master-role';
    const RESOURCE  = 'Master Role';

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
        $query = \DB::table('mst_role')
                    ->orderBy('mst_role.role_name');

        if (!empty($filters['isActive']) || !$request->session()->has('filters')) {
            $query->where('mst_role.is_active', '=', true);
        } else {
            $query->where('mst_role.is_active', '=', false);
        }

        if (!empty($filters['roleName'])) {
            $query->where('mst_role.role_name', 'like', '%'.$filters['roleName'].'%');
        }

        return view('master/master-role.index',[
            "models"        => $query->paginate(10),
            "filters"       => $filters,
            "url"           => self::URL,
            "resource"      => self::RESOURCE,
        ]);
    }

    public function add(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'add'])) {
            abort('403');
        } 

        $model              = new Role();
        $model->is_active   = true;
        
        return view('master/master-role.add',[
            "model"         => $model,
            "resources"     => config('app.resources'),
        ]);
    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $model = Role::find($id);

        return view('master/master-role.add',[
            "model"         => $model,
            "resources"     => config('app.resources'),
        ]);
    }

    public function save(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'add']) && !\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $id     = intval($request->get('id', 0));
        
        if(empty($request->get('isActive')) && $this->userExistThisRole($id)){
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.user-exist-this-role')]);
        }

        $this->validate($request, [
            'roleName' => 'required|max:200|unique:mst_role,role_name,'.$id.',role_id',
        ]);


        $now    = new \DateTime();
        if(empty($id)){
            $model  = new Role();
            $model->created_by      = \Auth::user()->id;
            $model->created_date    = $now;
        }else{
            $model  = Role::find($id);
            $model->last_updated_by   = \Auth::user()->id;
            $model->last_updated_date = $now;
        }

        $model->role_name   = $request->get('roleName');
        $model->is_active   = !empty($request->get('isActive')) ? true : false;
        
        if ($model->accessControl()->count() > 0) {
            $model->accessControl()->forceDelete();
        }
        
        $model->save();
        foreach ($request->get('privileges', []) as $resource => $privileges) {
            foreach ($privileges as $privilege => $access) {
                $accessControl = new AccessControl();
                $accessControl->role_id     = $model->role_id;
                $accessControl->resource    = $resource;
                $accessControl->privilege   = $privilege;
                $accessControl->save();
            }
        }


        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.master-role').' '.$model->role_name])
            );

        return redirect(route('master-role-index'));
    }

    private function userExistThisRole($roleId){
        $exist = false;
        $user  = \DB::table('users')
                    ->join('mst_role', 'mst_role.role_id', '=', 'users.role_id')
                    ->count();
        if($user > 0){
            $exist = true;
        }
        return $exist;
    }
}
