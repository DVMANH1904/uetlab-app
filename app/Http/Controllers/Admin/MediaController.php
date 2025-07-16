<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/media', $fileName);

            $media = Media::create([
                'file_name' => $fileName,
                'file_path' => "media/$fileName",
                'description' => $request->input('description'), // Lưu mô tả
            ]);

            return response()->json([
                'success' => true,
                'file_path' => $media->file_path,
                'file_name' => $media->file_name,
                'description' => $media->description,
            ]);
        }
        return response()->json(['success' => false]);
    }

    public function list()
    {
        // Lấy tất cả ảnh, trả về cả description
        $images = Media::select('id', 'file_name', 'file_path', 'description')->orderByDesc('id')->get();

        return response()->json($images);
    }
}
