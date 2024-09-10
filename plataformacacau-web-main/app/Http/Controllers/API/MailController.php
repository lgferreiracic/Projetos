<?php

namespace App\Http\Controllers\API;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends BaseController
{
    public function send_mail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'phone' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $send_mail = 'cacau@uesc.br';

        try {
            Mail::to($send_mail)->send(new SendMail($validatedData));
            return response()->json(['message' => 'E-mail enviado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao enviar o e-mail. Por favor, tente novamente mais tarde.'], 500);
        }
    }
}
