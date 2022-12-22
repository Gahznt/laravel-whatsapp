<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class WhatsappController extends Controller
{
    public function sendMessage($message){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v15.0/111112988462447/messages/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array("to" => '5535998715886', "messaging_product" => 'whatsapp', "recipient_type" => 'individual', "type" => "text", 'text' => [
                'body' => $message,
                'preview_url' => 'false'
            ])),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer EAAGwLg6sPm4BAM8kQubp3zkBiGUvOMvnio4BCLf7jJRqvuEELMKNntYpdXyVKfyskQC2TW2lW3Mdfd0r4lZBmZBz8dib5JJX09dkncI4yOP2zoLfjvETvvpN5f9nFGJ4HVT5l6NxvQqqSgwQgtX616YrsdnUQqFkD78GijS7FFZB0DCCi4lszyIsIDmjZCVXlPFkbqDJLwZDZD',
                'Content-Type: application/json'
            ),
        ));
    
        curl_exec($curl);
        curl_close($curl);
    }

    public function webhook(Request $request){
        Log::debug($request['entry'][0]['changes'][0]['value']['messages'][0]['text']['body']);
        $this->sendMessage("Olá fulano, seja bem vindo!");

        return response()->json($request->all());
    } 
}
