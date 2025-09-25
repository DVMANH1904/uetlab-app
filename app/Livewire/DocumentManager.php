<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentManager extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $file;
    public $search = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'file' => 'required|file|extensions:pdf,doc,docx,xls,xlsx,ppt,pptx,zip|max:10240',
    ];

    protected $messages = [
        'file.extensions' => 'Định dạng tệp không được hỗ trợ. Vui lòng tải lên các tệp PDF, Word, Excel, PowerPoint hoặc ZIP.',
    ];

    public function saveDocument()
    {
        $this->validate();

        $originalFilename = $this->file->getClientOriginalName();
        $path = $this->file->store('documents', 'public');

        Document::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'file_path' => $path,
            'original_filename' => $originalFilename,
            'file_type' => pathinfo($originalFilename, PATHINFO_EXTENSION),
            'file_size' => round($this->file->getSize() / 1024),
        ]);

        $this->reset(['title', 'description', 'file']);
        session()->flash('success', 'Tải tài liệu lên thành công!');
        $this->dispatch('close-modal');
    }

    public function deleteDocument($documentId)
    {
        $document = Document::find($documentId);
        if (auth()->user()->can('isAdmin') || auth()->id() === $document->user_id) {
            Storage::disk('public')->delete($document->file_path);
            $document->delete();
            session()->flash('success', 'Đã xóa tài liệu.');
        } else {
            session()->flash('error', 'Bạn không có quyền xóa tài liệu này.');
        }
    }

    /**
     * Xử lý việc tải xuống một tài liệu.
     * Đã được viết lại để sử dụng Storage::download(),
     * phương pháp được khuyến nghị cho Livewire.
     */
    public function downloadDocument($documentId)
    {
        $document = Document::findOrFail($documentId);

        // Tạo tên file thân thiện khi tải về
        $filename = $document->original_filename ?? Str::slug($document->title) . '.' . $document->file_type;

        // Trả về một response tải xuống trực tiếp từ Storage
        return Storage::disk('public')->download($document->file_path, $filename);
    }

    public function render()
    {
        $documents = Document::with('user')
            ->where('title', 'like', '%'.$this->search.'%')
            ->latest()
            ->get();

        return view('livewire.document-manager', [
            'documents' => $documents
        ]);
    }
}

