<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Files;
use Session;
use Illuminate\Http\Request;
class fileController extends Controller
{
    public function index()
    {
        $files = Files::select('*')->get();
        $data['files'] = $files;
        return view('uploadFile', $data);
    }
    public function dashboard()
    {
        $files = Files::select('*')->orderBy('index')->get();
        $data['files'] = $files;
        return view('dashboard', $data);
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg,pdf,xlsx,docx|max:2048',
            //  'index' => 'reuired'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        } else {
            if ($request->file('file')) {

                $file = $request->file('file');
                $filename = $file->hashName();

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // File path
                $filepath = url('uploads/' . $filename);

                // Insert record
                $insertData_arr = array(
                    'name' => $request->name,
                    'filepath' => $filepath,
                    'index' => $request->index
                );

                Files::create($insertData_arr);

                // Session
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Record inserted successfully.');
            } else {

                // Session
                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Record not inserted');
            }
        }

        return redirect('dashboard');
    }
    public function edit($id)
    {
        $files = Files::where('id', decrypt($id))->get();
        // $files = Files::find($id);
        return view('edit', compact('files'));
    }

    public function update(Request $request, $id)
    {
        $file = Files::find(decrypt($id));

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg,pdf,xlsx,docx|max:2048',
            //  'index' => 'reuired'
        ]);

        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
        } else {

            if ($request->file('file')) {

                $file = $request->file('file');
                $filename = $file->hashName();

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // File path
                $filepath = url('uploads/' . $filename);
                $file = Files::find(decrypt($id));
                $file->name = $request['name'];
                $file->filepath = $filepath;
                $file->index = $request['index'];
                $file->save();
                Session::flash('alert-class', 'alert-success');
                Session::flash('message', 'Record inserted successfully.');
            } else {

                Session::flash('alert-class', 'alert-danger');
                Session::flash('message', 'Record not inserted');
            }
        }
        $message = 'Your information updated successfully';
        return redirect('dashboard')->with('success', $message);
    }
    public function destroy($id)
    {
        $file = Files::find(decrypt($id));
        $file->delete();
        $message = 'Your information successfully deleted';
        return redirect('dashboard')->with('success', $message);
    }
}
