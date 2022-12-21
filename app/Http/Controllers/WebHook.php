<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BotWhatsApp\WhatsApp;

class WebHook extends Controller
{
    public function webhook(Request $request)//
    {

        $verifyToken = '123wsgyuhbj32222'; // You will specify it when you enable the Webhook for your app

        // Handle verification request
        if ($request['hub_verify_token'] === $verifyToken) {
            echo $request['hub_challenge'];
            exit;
        }
            
        // Handle payload
        $data = json_decode($request->getContent(), true);

        self::send($data['entry'][0]['changes'][0]['value']['messages'][0]);
        // ['from']
        // ['interactive']['list_reply']
        file_put_contents('webhook.text', $data);
        
        exit(1);
        
    }

    public static function send($mess){

        WhatsApp::system($mess);
        // dd(WhatsApp::$message);
        
        $url = "https://graph.facebook.com/v15.0/106758715575020/messages";

        $content = json_encode(WhatsApp::$message);
        // dd($content);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Content-type: application/json",
                'Authorization: Bearer EAAQUs0T5kWgBACvlcmteHBhwPcSgqzScBNWBGffyiYKV0myfs6urOScryGTM0ZA34jelqJ5VBe8TJFxhf3yum9lQ82t429o8XIfrOPIexENI6zC9Hsp7SDsgYG3dzMRT88H9BPPTEfBG5mkxKac7h6Yrt722zFtPyi06yofTYWgNTP4tMawNm4iOYDmgDkRejHeVjhIQeqLihqcsn'
            )
        );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        
        $json_response = curl_exec($curl);
        
        curl_close($curl);
        
    }
}
