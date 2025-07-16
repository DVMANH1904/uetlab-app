<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time().'_'.$file->getClientOriginalName();

            // Đảm bảo thư mục tồn tại ở public/media/image
            $dir = public_path('media/image');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            // Lưu file vào public/media/image
            $file->move($dir, $fileName);

            $media = Media::create([
                'file_name' => $fileName,
                'file_path' => "media/image/$fileName",
                'description' => $request->input('description'),
            ]);

            return response()->json([
                'success' => true,
                'file_path' => $media->file_path,
                'file_name' => $media->file_name,
                'description' => $media->description,
            ]);
        }
        return response()->json(['success' => false, 'message' => 'No image uploaded']);
    }

    public function list()
    {
        // Lấy tất cả ảnh, trả về cả description
        $images = Media::select('id', 'file_name', 'file_path', 'description')->orderByDesc('id')->get();

        return response()->json($images);
    }
}

