<?php

namespace App\Http\Controllers;

use App\Models\Backup;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminServerController extends Controller
{
    public function database() {
        $page = 'database';
        $data = Backup::orderBy('id', 'desc')->paginate(10);
        return view('Pages.Admin.Database.Database', compact('page', 'data'));
    }

    public function addDatabase() {
        Artisan::call('database:backup');
        return back()->with('message', 'Export Database Successfully');
    }

    public function deletDatabase($id) {
        $database = Backup::where('id', $id)->first();
        if (file_exists(storage_path() . "/app/backup/" . $database->name)) {
            unlink(storage_path() . "/app/backup/" . $database->name);
        }
        $database->delete();
        return back()->with('message', 'Database Deleted Successfully');
    }

    public function importDatabase($id) {
        $database = Backup::where('id', $id)->first();
        if (file_exists(storage_path() . "/app/backup/" . $database->name)) {
            $returnVar  = NULL;
            $output     = NULL;
            $command = "mysql --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . " < " . storage_path() . "/app/backup/" . $database->name . "";
            exec($command, $output, $returnVar);
            return back()->with('message', 'Database Restored');
        }
        else{
            return back()->with('message', 'Database Deleted Successfully');
        }
    }

    // Server Settings
    public function server() {
        $page = 'server';
        $data = Setting::first();
        return view('Pages.Admin.Server.Server', compact('page', 'data'));
    }

    public function mail(Request $request) {
        $check = Setting::all();
        if (count($check) >= 1) {
            Setting::first()->update([
                'mail_transport' => $request->mail_transport,
                'mail_host' => $request->mail_host,
                'mail_port' => $request->mail_port,
                'mail_username' => $request->mail_username,
                'mail_password' => $request->mail_password,
                'mail_encryption' => $request->mail_encryption,
                'mail_from' => $request->mail_from,
                'mail_from_name' => $request->mail_from_name
            ]);
            return back()->with('message', 'Updated Successfully');
        }
        else{
            Setting::insert([
                'mail_transport' => $request->mail_transport,
                'mail_host' => $request->mail_host,
                'mail_port' => $request->mail_port,
                'mail_username' => $request->mail_username,
                'mail_password' => $request->mail_password,
                'mail_encryption' => $request->mail_encryption,
                'mail_from' => $request->mail_from,
                'mail_from_name' => $request->mail_from_name,
                'created_at' => Carbon::now()
            ]);
            return back()->with('message', 'Added Successfully');
        }
    }
}
