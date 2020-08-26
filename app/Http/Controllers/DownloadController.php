<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    function get_youtube($url){

        $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

        $curl = curl_init($youtube);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);

    }
    public function DownloadVideo(Request $request_uri){

       return $this->get_youtube($request_uri->vid_url);
    }
}
