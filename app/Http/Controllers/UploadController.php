<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // Hanya izinkan file PDF dengan ukuran maksimal 2MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public'); // Simpan file ke direktori 'storage/app/public/uploads'

            // Simpan informasi tentang dokumen ke dalam tabel 'documents'
            $document = new Document();
            $document->name = $file->getClientOriginalName();
            $document->file_path = $filePath;
            $document->save();

            return response()->json(['success' => true, 'message' => 'Document uploaded successfully']);
        }

        return response()->json(['message' => 'Document uploaded successfully.']);
    }
}
