<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function showUploadForm()
    {
        return view('upload-document');
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $document = new Document();
            $document->name = $file->getClientOriginalName();
            $document->file_path = $filePath;
            $document->save();

            return response()->json(['success' => true, 'message' => 'Document uploaded successfully']);
        }

        return response()->json(['success' => false, 'message' => 'File not found']);
    }
}
