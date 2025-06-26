<?php

namespace App\Http\Controllers;

use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function destroy($id)
{
    $item = WorkSchedule::where('id', $id)->first();
    if ($item) {
        $item->delete();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false, 'message' => 'Không tìm thấy bản ghi'], 404);
}
}


