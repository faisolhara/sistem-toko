<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Master\MasterUom;
use App\Service\Master\UomService;

class MasterUomController extends Controller
{
    const URL       = 'master-uom';
    const RESOURCE  = 'Master Uom';

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
        $query = \DB::table('mst_uom')
                    ->select('mst_uom.*', 'parent.uom_name as parent_name')
                    ->leftJoin('mst_uom as parent', 'parent.uom_id', '=', 'mst_uom.parent_base')
                    ->orderBy('uom_name');

        if (!empty($filters['isActive']) || !$request->session()->has('filters')) {
            $query->where('mst_uom.is_active', '=', true);
        } else {
            $query->where('mst_uom.is_active', '=', false);
        }

        if (!empty($filters['uomName'])) {
            $query->where('mst_uom.uom_name', 'like', '%'.$filters['uomName'].'%');
        }

        if (!empty($filters['uomCode'])) {
            $query->where('mst_uom.uom_code', 'like', '%'.$filters['uomCode'].'%');
        }

        return view('master/master-uom.index',[
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

        $model              = new MasterUom();
        $model->is_active   = true;
        
        return view('master/master-uom.add',[
            "model"         => $model,
            "title"         => trans('fields.add'),
            "uomOptions"    => UomService::getUomIsBase(),
        ]);

    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        }  

        $model = MasterUom::find($id);

        return view('master/master-uom.add',[
            "model"         => $model,
            "title"         => trans('fields.edit'),
            "uomOptions"    => UomService::getUomIsBase(),
        ]);
    }

    public function save(Request $request)
    {
        // dd($request->all());
        if (!\Gate::allows('access', [self::RESOURCE, 'add']) && !\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $id     = intval($request->get('id'));
        
        $this->validate($request, [
            'uomCode'       => 'required|max:200|unique:mst_uom,uom_code,'.$id.',uom_id',
            'uomName'       => 'required|max:255',
        ]);

        if(empty($request->get('isBase')) && empty($request->get('parentBase'))){
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => trans('message.is-base-or-parent-base-required')]);
        }

        $now = new \DateTime();     
        if(empty($id)){
            $model                     = new MasterUom();
            $model->created_by         = \Auth::user()->id;
            $model->created_date       = $now;
        }else{
            $model                     = MasterUom::find($id);
            $model->last_updated_by    = \Auth::user()->id;
            $model->last_updated_date  = $now;
        }

        $model->uom_code    = $request->get('uomCode');
        $model->uom_name    = $request->get('uomName');
        $model->parent_base = empty($request->get('isBase')) ? $request->get('parentBase') : null;
        $model->is_base     = !empty($request->get('isBase')) ? true : false;
        $model->is_active   = !empty($request->get('isActive')) ? true : false;
        
        $model->save();

        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.master-uom').' '.$model->uom_name])
            );

        return redirect(route('master-uom-index'));
    }
}
