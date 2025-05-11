<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class AdminNotifikasiController extends Controller
{
    public function index()
    {
        $notifications = DatabaseNotification::with('notifiable')
            ->latest()
            ->paginate(10);

        return view('notifikasi.index', compact('notifications'));
    }
    public function create()
    {
        $santris = \App\Models\Santri::with('user')->get();
        return view('notifikasi.create', compact('santris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        $user = \App\Models\User::find($request->santri_id);

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'url' => route('dashboard'),
        ];

        $user->notify(new \App\Notifications\AdminCustomNotification($data));

        return redirect()->route('notifikasi.create')->with('success', 'Notifikasi berhasil dikirim.');
    }
    public function destroy($id)
    {
        $notif = \Illuminate\Notifications\DatabaseNotification::findOrFail($id);
        $notif->delete();

        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil dihapus.');
    }

    public function edit($id)
    {
        $notif = \Illuminate\Notifications\DatabaseNotification::findOrFail($id);
        $santris = \App\Models\Santri::with('user')->get();

        return view('notifikasi.edit', compact('notif', 'santris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        $notif = \Illuminate\Notifications\DatabaseNotification::findOrFail($id);
        $data = $notif->data;
        $data['title'] = $request->title;
        $data['message'] = $request->message;
        $notif->data = $data;
        $notif->save();

        return redirect()->route('notifikasi.index')->with('success', 'Notifikasi berhasil diperbarui.');
    }
}
