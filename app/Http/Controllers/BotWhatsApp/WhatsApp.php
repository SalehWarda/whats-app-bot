<?php

namespace App\Http\Controllers\BotWhatsApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\qeu;
use App\Models\phone;

class WhatsApp extends Controller
{

    public static $message=array(
        "messaging_product"=> "whatsapp",
        "recipient_type"=> "individual",
        "to"=> null,
    );

    public static function system($mess)
    {
        $phone=phone::where('phone', $mess['from']);
        self::$message['to']=$mess['from'];

        if($phone == null){
            
            $messg=qeu::with('buttons')->where('frist', 1)->toArray();
            phone::create([
                'phone'=>$mess['from'],
                'language'=>1
            ]);

        }else{

            $messg=qeu::with('lsits.titles.rows')->find($mess['interactive']['list_reply']['id'])->toArray();

        }

        self::body($messg);

        if(self::$message['interactive']['type']=='list'){
            self::list($messg['lsits']);
            return 1;
        }

        self::button($messg['buttons']);
    
    }


    public static function body($messages)
    {
        
        self::$message['type']="interactive";
        self::$message['interactive']=[
            'type'=>$messages['type']
        ];

        if($messages['header'])
        {
            self::$message['interactive']['header']=[
                'type'=>'text',
                'text'=>$messages['header']
            ];
        }

        if($messages['body'])
        {
            self::$message['interactive']['body']=[
                'text'=>$messages['body']
            ];
        }

        if($messages['footer'])
        {
            self::$message['interactive']['footer']=[
                'text'=>$messages['footer']
            ];
        }
        
    }

    public static function button($button)
    {
        
        $info=['type'=>'reply','reply'=>['id'=>0,'title'=>0]];
        $infow=[];
        foreach ($button as $value) {

            $info['reply']['id']=$value['ansr_id'];
            $info['reply']['title']=$value['title'];

            $infow[]=$info;

        }

        self::$message['interactive']['action']['buttons']=$infow;

    }

    public static function list($list){//
        
        $inf=[
            'title'=>'title',
            'rows'=>[
                ['id'=>'id',
                'title'=>'title',
                'description'=>'description']
            ]
        ];
        $infow=[];

        foreach ($list as $value) {

            self::$message['interactive']['action']['button']=$value['button'];

            foreach ($value['titles'] as $val) {
                $inf['title']=$val['title'];

                foreach ($val['rows'] as $va) {

                    $inf['rows'][0]['id']=$va['ansr_id'];
                    $inf['rows'][0]['title']=$va['title'];
                    if($va['description']){
                        $inf['rows'][0]['description']=$va['description'];
                    }
                }
            }

            $infow[]=$inf;
        }

        self::$message['interactive']['action']['sections']=$infow;

    }

}
