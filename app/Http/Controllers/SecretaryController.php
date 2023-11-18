<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileRequest;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\Request;

class SecretaryController extends Controller
{
    public function SecretaryDashboard(){
        $users = User::where('department_id',auth()->user()->department_id)->count();
        $folders = auth()->user()->department->folders->count();
        $files = File::whereHas('folder',function($q){
            $q->where('department_id',auth()->user()->department_id);
        })->where('is_locked',0)->count();
        $department_users = User::where('department_id',auth()->user()->department_id)->pluck('id')->toArray();
        $requests = FileRequest::whereIn('user_id',$department_users)->get();
        return view('secretary.secretary_dashboard',compact('users','folders','files','requests'));
    }
    public function users(){
        $users = User::where('department_id',auth()->user()->department_id)->get();
        return view('secretary.users',compact('users'));
    }

    public function editUser(User $user)
    {
        $user->update([
            'name' => request()->name,
            'email' => request()->email,
            'phone' => request()->phone
        ]);
        $notification = array(
            'message' => 'User updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deactivateUser(User $user)
    {
        $user->update([
            'status' => 'inactive'
        ]);
        $notification = array(
            'message' => 'User deactivated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function files()
    {
        $files = File::whereHas('folder',function($q){
            $q->where('department_id',auth()->user()->department_id);
        })->where('is_locked',0)->get();
        $folders = auth()->user()->department->folders;
        return view('secretary.manage-files',compact('files','folders'));
    }

    public function folders()
    {
        $folders = auth()->user()->department->folders;
        return view('secretary.folders',compact('folders'));
    }

    public function storeFolders()
    {
        $folder = auth()->user()->department->folders()->create([
            'name' => request()->name,
            'user_id' => auth()->user()->id
        ]);
        $notification = array(
            'message' => 'Folder created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function editFolder(Folder $folder)
    {
        $folder->update([
            'name' => request()->name
        ]);
        $notification = array(
            'message' => 'Folder updated successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteFolder(Folder $folder)
    {
        $folder->delete();
        $notification = array(
            'message' => 'Folder deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,txt|max:2048', // Adjust the allowed file types and size
            'type' => 'required',
        ]);

        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();
        $path = $uploadedFile->storeAs('uploads', $filename); // Store the file in the "storage/app/uploads" directory

        File::create([
            'name' => $request->input('name'),
            'user_id' => auth()->id(), // Assuming you have user authentication
            'path' => $path,
            'type' => $request->input('type'),
            'folder_id' => $request->input('folder_id'),
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
            'type'=> 'required',
        ]);

        $file->update([
            'name' => $request->input('new_title'),
            'type' => $request->input('type'),
        ]);


        $notification = array(
            'message' => 'File Edited successfully.',
            'alert-type' => 'success'
        );



        return redirect()->back()->with($notification);
    }

    public function archive(File $file)
    {
        // Update the file's status to "inactive" or archive it
        $file->update(['is_achieved' => true]);

        $notification = array(
            'message' => 'File Achieved successfully.',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }
    public function lock(File $file)
    {
        // Update the file's status to "inactive" or archive it
        $file->update(['is_locked' => true]);

        $notification = array(
            'message' => 'File Locked successfully.',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }
    public function unlock(File $file)
    {
        // Update the file's status to "inactive" or archive it
        $file->update(['is_locked' => false]);

        $notification = array(
            'message' => 'File unlocked successfully.',
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

    public function viewArchivedFiles()
    {

        $files = File::where('is_achieved', true)->get();
        return view('admin.achieved-files', compact('files'));
    }

    public function unarchive(File $file)
    {
        // Update the file's status to "active" or unarchive it
        $file->update(['is_achieved' => false]);

        $notification = array(
            'message' => 'File Uarchived successfully.',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }

    public function fileRequests()
    {
        $department_users = User::where('department_id',auth()->user()->department_id)->pluck('id')->toArray();
        $requests = FileRequest::whereIn('user_id',$department_users)->get();
        return view('secretary.manage-requests', compact('requests'));
    }

    public function approveFileRequests(FileRequest $request)
    {
        $request->update(['status' => 'approved']);
        $notification = array(
            'message' => 'File Request approved successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function rejectFileRequests(FileRequest $request)
    {
        $request->update(['status' => 'rejected']);
        $notification = array(
            'message' => 'File Request rejected successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function cancelFileRequests(FileRequest $request)
    {
        $request->delete();
        $notification = array(
            'message' => 'File Request cancelled successfully.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
