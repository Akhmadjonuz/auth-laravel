<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SendController extends Controller
{
    public function send(Request $request)
    {

        //create directory is not exist images
        if (!file_exists(public_path('images'))) {
            mkdir(public_path('images'), 0777, true);
        }

        //limit messages in one day
        $messages = Message::where('time', '>=', date('Y-m-d 00:00:00'))->where('email', Auth::user()->email)->get();
        if (count($messages) >= 1) {
            return view('home',['error' => 'Сообщение не отправлено. Вы можете отправить сообщение через 24 часа.']);
        } else {
            $user = User::where('email', Auth::user()->email)->first();
            $photo = $request->file('photo');
            $photo->move(public_path('images'), $photo->getClientOriginalName());
            $photo_name = $photo->getClientOriginalName();
            $message = new Message;
            $message->name = $user->name;
            $message->email = $user->email;
            $message->message = $request->text;
            $message->theme = $request->theme;
            $message->status = 'new';
            $message->url_file = 'https://' . $_SERVER['HTTP_HOST'] . '/images/' . $photo_name;
            $message->time = date('Y-m-d H:i:s');
            $message->timestamps = false;
            $message->save();
            return view('home',['error' => 'Сообщение отправлено']);
        }
    }

    public function showManager()
    {
        $messages = Message::where('status', 'new')->orWhere('status', 'old')->orderBy('time', 'desc')->get();
        return view('manager', ['messages' => $messages]);
    }

    public function change(Request $request)
    {
        $message = Message::where('id', $request->id)->first();
        $message->status = 'old';
        $message->save();
        return redirect('/manager');
    }
}
