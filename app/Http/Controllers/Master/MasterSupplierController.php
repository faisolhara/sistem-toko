<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\MasterSupplier;
use App\Model\Master\AccessControl;
use App\Service\Numbering;

class MasterSupplierController extends Controller
{
    const URL       = 'master-supplier';
    const RESOURCE  = 'Master Supplier';

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
        $query = \DB::table('mst_supplier')
                    ->orderBy('mst_supplier.supplier_code');

        if (!empty($filters['isActive']) || !$request->session()->has('filters')) {
            $query->where('mst_supplier.is_active', '=', true);
        } else {
            $query->where('mst_supplier.is_active', '=', false);
        }

        if (!empty($filters['supplierName'])) {
            $query->where('mst_supplier.supplier_name', 'like', '%'.$filters['supplierName'].'%');
        }

        if (!empty($filters['supplierCode'])) {
            $query->where('mst_supplier.supplier_code', 'like', '%'.$filters['supplierCode'].'%');
        }

        if (!empty($filters['personName'])) {
            $query->where('mst_supplier.person_name', 'like', '%'.$filters['personName'].'%');
        }

        return view('master/master-supplier.index',[
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

        $model              = new MasterSupplier();
        $model->is_active   = true;
        
        return view('master/master-supplier.add',[
            "model"         => $model,
            "resources"     => config('app.resources'),
        ]);
    }

    public function edit(Request $request, $id)
    {
        if (!\Gate::allows('access', [self::RESOURCE, 'update'])) {
            abort('403');
        } 

        $model = MasterSupplier::find($id);

        return view('master/master-supplier.add',[
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
            'supplierName' => 'required|max:200|unique:mst_supplier,supplier_name,'.$id.',supplier_id',
        ]);

        $now    = new \DateTime();
        if(empty($id)){
            $model  = new MasterSupplier();
            $model->supplier_code   = $this->getCustomerCode();
            $model->created_by      = \Auth::user()->id;
            $model->created_date    = $now;
        }else{
            $model  = MasterSupplier::find($id);
            $model->last_updated_by   = \Auth::user()->id;
            $model->last_updated_date = $now;
        }

        $model->supplier_name   = $request->get('supplierName');
        $model->person_name     = $request->get('personName');
        $model->contact_person  = $request->get('contactPerson');
        $model->telephone       = $request->get('telephone');
        $model->description     = $request->get('description');
        $model->address         = $request->get('address');
        $model->is_active       = !empty($request->get('isActive')) ? true : false;
        
        $model->save();
        
        $request->session()->flash(
            'successMessage',
            trans('message.saved-message', ['variable' => trans('menu.master-supplier').' '.$model->supplier_name])
            );

        return redirect(route('master-supplier-index'));
    }

    private function getCustomerCode(){
        $date         = new \DateTime();

        $count        = \DB::table('mst_supplier')->count();
        $customerCode = 'SP.'.$date->format('y').Numbering::getStringNumber($count+1, 4);

        return $customerCode;
    }
}
