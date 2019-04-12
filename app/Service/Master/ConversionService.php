<?php 

namespace App\Service\Master;

use App\Model\Master\MasterItem;
use App\Model\Master\MasterUom;
use App\Model\Master\Conversion;

class ConversionService
{
    public static function conversion($uomId, $itemId, $value)
    {
        $item = MasterItem::find($itemId);

        if($item->uom_id == $uomId){
            return $value;
        }

        $conversion = Conversion::where('uom_id_from', '=', $uomId)
                                        ->where('uom_id_to', '=', $item->uom_id)->first();
        return $conversion->conversion * $value;
     
    }
}