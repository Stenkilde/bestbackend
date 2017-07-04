<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Video;
use App\Vod;

class VideoController extends Controller {
    
    public function get() {
        return Video::all();
    }

    public function show(Request $request) {
        $video = Video::where('title', 'LIKE', '%' . $request->input('title') . '%')->first();

        if (!empty($video)) {
            $vods = Vod::where('video_id', $video->id)->get();
            foreach ($vods as $v) {
                $games[] = ["game" => $v->game];
                $urls[] = ["url" => $v->url, "game" => $v->game];
            }

            $video->vods = ["games" => $games, "urls" => $urls];

            return $video;
        }

        return $video;

        return ['message' => 'Sorry, we found nothing'];
    }

    public function typeahead(Request $request) {
        $video = Video::where('title', 'LIKE', '%' . $request->input('search') . '%')->get();

        return $video;
    }
}
