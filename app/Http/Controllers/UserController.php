<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function files()
    {
        $files = auth()->user()->files;
        return view('user.manage-files',compact('files'));
    }
    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,txt|max:2048', // Adjust the allowed file types and size
        ]);

        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();
        $path = $uploadedFile->storeAs('uploads', $filename); // Store the file in the "storage/app/uploads" directory

        File::create([
            'name' => $request->input('name'),
            'user_id' => auth()->id(), // Assuming you have user authentication
            'path' => $path,
            'type' => 'restricted'
        ]);
        $notification = array(
            'message' => 'File uploaded successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function download($file)
    {
        $file = File::find($file);

        if ($file) {
            $filePath = storage_path('app/' . $file->path);

            if (file_exists($filePath)) {
                return response()->download($filePath, $file->name);
            } else {
                return redirect()->back()->with('error', 'File not found.');
            }
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function update(Request $request, File $file)
    {
        $request->validate([
            'new_title' => 'required|string|max:255',
        ]);

        $file->update([
            'name' => $request->input('new_title'),
        ]);

        $notification = array(
            'message' => 'File Edited successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteFile(File $file)
    {

        $file->delete();
        $notification = array(
            'message' => 'File deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function fileRequest()
    {
        $requests = auth()->user()->fileRequests;
        $files = File::whereHas('folder',function($q){
            $q->where('department_id',auth()->user()->department_id);
        })->where('type','restricted')->get();
        return view('user.manage-requests',compact('requests','files'));
    }

    public function storeRequest(Request $request)
    {
        $request->validate([
            'file_id' => 'required',
            'reason' => 'required|string|max:255',
        ]);

        auth()->user()->fileRequests()->create([
            'file_id' => $request->input('file_id'),
            'message' => $request->input('reason'),
        ]);

        $notification = array(
            'message' => 'File Requested successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
