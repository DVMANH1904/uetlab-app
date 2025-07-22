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
    public function upload_video(Request $request)
    {
        $request->validate([
            'video' => 'required|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:51200',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $fileName = time().'_'.$file->getClientOriginalName();

            // Đảm bảo thư mục tồn tại ở public/media/video
            $dir = public_path('media/video');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            // Lưu file vào public/media/video
            $file->move($dir, $fileName);

            $media = Media::create([
                'file_name' => $fileName,
                'file_path' => "media/video/$fileName",
                'description' => $request->input('description'),
            ]);

            return response()->json([
                'success' => true,
                'file_path' => $media->file_path,
                'file_name' => $media->file_name,
                'description' => $media->description,
            ]);
        }
        return response()->json(['success' => false, 'message' => 'No video uploaded']);
    }
    public function upload_document(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt|max:20480',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time().'_'.$file->getClientOriginalName();

            // Đảm bảo thư mục tồn tại ở public/media/document
            $dir = public_path('media/document');
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            // Lưu file vào public/media/document
            $file->move($dir, $fileName);

            $media = Media::create([
                'file_name' => $fileName,
                'file_path' => "media/document/$fileName",
                'description' => $request->input('description'),
            ]);

            return response()->json([
                'success' => true,
                'file_path' => $media->file_path,
                'file_name' => $media->file_name,
                'description' => $media->description,
            ]);
        }
        return response()->json(['success' => false, 'message' => 'No document uploaded']);
    }
    public function list()
    {
        // Lấy tất cả ảnh, trả về cả description
        $images = Media::select('id', 'file_name', 'file_path', 'description')->orderByDesc('id')->get();

        return response()->json($images);
    }
    public function list_video()
    {
        $videos = Media::select('id', 'file_name', 'file_path', 'description')
            ->where(function($query) {
                $query->where('file_path', 'like', 'media/video/%');
            })
            ->orderByDesc('id')->get();

        return response()->json($videos);
    }
    public function list_document()
    {
        // Lấy tất cả document, trả về cả description
        $documents = Media::select('id', 'file_name', 'file_path', 'description')
            ->where(function($query) {
                $query->where('file_path', 'like', 'media/document/%');
            })
            ->orderByDesc('id')->get();

        return response()->json($documents);
    }
}

