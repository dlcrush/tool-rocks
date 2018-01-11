<?php

namespace App\Processors;

use App\Video;
use App\VideoImage;
use App\Processors\Contracts\VideoProcessor as VideoProcessorContract;
use App\Repositories\API\Contracts\YouTubeRepository;

class VideoProcessor implements VideoProcessorContract {

    public function __construct(YouTubeRepository $youTubeRepo) {
        $this->youTubeRepo = $youTubeRepo;
    }

    function process(Video $video, $processImages=true) {
        \Log::info('START - Processing video id: ' . $video->id);
        $ytVideo = $this->youTubeRepo->getVideo(['id' => $video->video_id]);

        $video->views = $ytVideo->views;
        $video->thumbs_up = $ytVideo->thumbsUp;
        $video->thumbs_down = $ytVideo->thumbsDown;
        $video->published_at = $ytVideo->publishedAt;
        $video->channel_id = $ytVideo->channelId;

        $video->save();

        if ($processImages) {
            // TODO: Group these together using transactions to limit DB hits
            $images = $ytVideo->images;
            foreach($images as $size => $image) {
                $videoImage = VideoImage::where('video_id', '=', $video->id)->where('size', $size)->get()->first();
                if (sizeof($videoImage) < 1) {
                    // no match, let's create a new one!
                    $videoImage = new VideoImage;
                }

                $videoImage->size = $size;
                $videoImage->height = $image->height;
                $videoImage->width = $image->width;
                $videoImage->url = $image->url;
                $videoImage->video_id = $video->id;
                $videoImage->save();
            }
        }
        \Log::info('END - Finished processing video id: ' . $video->id);
    }

}
