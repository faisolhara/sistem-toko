<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Conversion;
use App\Model\Master\AccessControl;
use App\Service\Master\UomService;       

class MasterConversionController extends Controller
{
    const URL       = 'master-conversion';
    const RESOURCE  = 'Master Conversion';

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
        $query = \DB::table('mst_conversion')
                    ->select('mst_conversion.*', 'uom_from.uom_name as uom_name_from', 'uom_to.uom_name as uom_name_to')
                    ->join('mst_uom as uom_from', 'uom_from.uom_id', '=', 'mst_conversion.uom_id_from')
                    ->join('mst_uom as uom_to', 'uom_to.uom_id', '=', 'mst_conversion.uom_id_to')
                    ->orderBy('uom_from.uom_name');

        if (!empty($filters['isActive']) || !$request->session()->has('filters')) {
            $query->where('mst_conversion.is_active', '=', true);
        } else {
            $query->where('mst_conversion.is_active', '=', false);
        }

        if (!empty($filters['uomNameFrom'])) {
            $query->where('uom_from.uom_name', 'like', '%'.$filters['uomNameFrom'].'%');
        }

        if (!empty($filters['uomNameTo'])) {
            $query->where('uom_to.uom_name', 'like', '%'.$filters['uomNameTo'].'%');
        }

        return view('master/master-conversion.index',[
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

        $model              = new Conversion();
        $model->is_active   = true;

        return view('master/master-conversion.add',[
            "model"             => $model,
            "uomOptionFrom"     => UomService::getUomNotBase(),
            "title"             => trans('fields.add')
        ]);
    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $model = Conversion::find($id);

        return view('master/master-conversion.add',[
            "model"             => $model,
            "uomOptionFrom"     => UomService::getUomNotBase(),
            "title"             => trans('fields.add')
        ]);
    }

    public function save(Request $request)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'add']) && !\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $id     = intval($request->get('id', 0));
        
        $this->validate($request, [
            'uomFrom'       => 'required',
            'uomToId'       => 'required',
            'conversion'    => 'required',
        ]);

        $now    = new \DateTime();
        if(empty($id)){
            $model  = new Conversion();
            $model->created_by      = \Auth::user()->id;
            $model->created_date    = $now;
        }else{
            $model  = Conversion::find($id);
            $model->last_updated_by   = \Auth::user()->id;
            $model->last_updated_date = $now;
        }

        $model->uom_id_from     = $request->get('uomFrom');
        $model->uom_id_to       = $request->get('uomToId');
        $model->conversion      = $request->get('conversion');
        $model->is_active   = !empty($request->get('isActive')) ? true : false;
        
        $model->save();
        
        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.master-conversion').' '.$model->category_name])
            );

        return redirect(route('master-conversion-index'));
    }

    public function getUom(Request $request)
    {
        $uomTo = \DB::table('mst_uom')
                    ->select('uom_to.*')
                    ->join('mst_uom as uom_to', 'uom_to.uom_id', '=', 'mst_uom.parent_base')
                    ->where('mst_uom.uom_id', '=', $request->get('uomFrom'))
                    ->first();
        return response()->json($uomTo);
    }

}