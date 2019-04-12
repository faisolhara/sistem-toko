<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Category;
use App\Model\Master\AccessControl;

class MasterCategoryController extends Controller
{
    const URL       = 'master-category';
    const RESOURCE  = 'Master Category';

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
        $query = \DB::table('mst_category')
                    ->orderBy('mst_category.category_name');

        if (!empty($filters['isActive']) || !$request->session()->has('filters')) {
            $query->where('mst_category.is_active', '=', true);
        } else {
            $query->where('mst_category.is_active', '=', false);
        }

        if (!empty($filters['categoryName'])) {
            $query->where('mst_category.category_name', 'like', '%'.$filters['categoryName'].'%');
        }

        return view('master/master-category.index',[
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

        $model              = new Category();
        $model->is_active   = true;
        
        return view('master/master-category.add',[
            "model"         => $model,
            "resources"     => config('app.resources'),
        ]);
    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $model = Category::find($id);

        return view('master/master-category.add',[
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
        
        $this->validate($request, [
            'categoryName' => 'required|max:200|unique:mst_category,category_name,'.$id.',category_id',
        ]);

        $now    = new \DateTime();
        if(empty($id)){
            $model  = new Category();
            $model->created_by      = \Auth::user()->id;
            $model->created_date    = $now;
        }else{
            $model  = Category::find($id);
            $model->last_updated_by   = \Auth::user()->id;
            $model->last_updated_date = $now;
        }

        $model->category_name   = $request->get('categoryName');
        $model->is_active   = !empty($request->get('isActive')) ? true : false;
        
        $model->save();
        
        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.master-category').' '.$model->category_name])
            );

        return redirect(route('master-category-index'));
    }
}
