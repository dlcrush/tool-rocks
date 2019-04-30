<?php

namespace App\Repositories\API;

use App\Repositories\API\Contracts\YouTubeRepository as YouTubeRepositoryInterface;
use App\Library\Http\UrlBuilder;
use App\Library\Http\Http;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use App\YouTubeVideo;
use App\YouTubeChannel;
use Carbon\Carbon;

class YouTubeRepository implements YouTubeRepositoryInterface {

    protected $baseAPIUrl = 'https://www.googleapis.com/youtube/v3/';
    protected $apiKey;
    protected $urlBuilder;
    protected $http;

    public function __construct(Http $http, UrlBuilder $urlBuilder, String $apiKey) {
        $this->http = $http;
        $this->urlBuilder = $urlBuilder;
        $this->urlBuilder->setBaseUrl('https://www.googleapis.com/youtube/v3/');
        $this->urlBuilder->addParam('key', $apiKey);
        $this->http->setTTL(5);
        $this->apiKey = $apiKey;
    }

    public function getVideos($data=[], $options=[]) {
        if (! is_array($data)) {
            $data = ['id' => $data];
        }

        $includeChannel = array_key_exists('includeChannel', $options) ? $options['includeChannel'] == true : false;


        $params = array_merge([
            'part' => 'snippet,statistics,contentDetails'
        ], $data);

        $url = $this->urlBuilder
            ->path('videos')
            ->params($params)
            ->build();

        $response = json_decode($this->http->get($url));

        $videos = new Collection();

        foreach($response->items as $v) {
            $video = new YouTubeVideo();

            $snippet = $v->snippet;
            $statistics = $v->statistics;
            $contentDetails = $v->contentDetails;

            $video->title = $snippet->title;
            $video->description = $snippet->description;
            $video->id = $v->id;
            $video->channelId = $snippet->channelId;
            $video->images = $snippet->thumbnails;
            $video->publishedAt = Carbon::parse($snippet->publishedAt)->toDateTimeString();
            $video->views = $statistics->viewCount;
            $video->thumbsUp = isset($statistics->likeCount) ? $statistics->likeCount : null;
            $video->thumbsDown = isset($statistics->dislikeCount) ? $statistics->dislikeCount : null;
            $video->comments = isset($statistics->commentCount) ? $statistics->commentCount : null;
            $video->favorites = isset($statistics->favoriteCount) ? $statistics->favoriteCount : null;
            if ($includeChannel) {
                $video->channel = $this->getChannelById($video->channelId);
            }
            $video->duration = isset($contentDetails->duration) ? $this->parseDuration($contentDetails->duration) : null;


            $videos->push($video);
        }

        return $videos;
    }

    public function getVideosByChannel($channelName) {
        $channel = $this->getChannelByUsername($channelName);
        $channelPlaylistId = $channel->contentDetails->relatedPlaylists->uploads;

        $videos = $this->getVideosByPlaylistId($channelPlaylistId);

        return $videos;
    }

    public function getChannel($data=[]) {
        if (! is_array($data)) {
            $data = ['id' => $data];
        }

        return $this->getChannelById($data['id']);
    }

    public function getChannelById($id) {

        $this->http->setTTL(60);

        $url = $this->urlBuilder
            ->path('channels')
            ->params([
                'part' => 'snippet,statistics',
                'id' => $id
            ])
            ->build();

        $res = $this->http->get($url);

        $this->http->setTTL(5);

        $items = json_decode($res)->items;

        if (count($items) > 0) {
            $item = $items[0];

            $channel = new YouTubeChannel();

            $snippet = $item->snippet;
            $statistics = $item->statistics;

            $channel->id = $item->id;
            $channel->name = $snippet->title;
            $channel->description = $snippet->description;
            $channel->slug = isset($snippet->customUrl) ? $snippet->customUrl : null;
            $channel->images = $snippet->thumbnails;
            $channel->views = $statistics->viewCount;
            $channel->subscribers = $statistics->subscriberCount;
            $channel->uploads = $statistics->videoCount;

            return $channel;
        }

        return null;
    }

    public function getVideosByPlaylistId($playlistId) {
        $url = $this->urlBuilder
            ->path('playlistItems')
            ->params([
                'part' => 'snippet,contentDetails',
                'maxResults' => '50',
                'playlistId' => $playlistId
            ])
            ->build();

        $res = $this->http->get($url);

        $videos = json_decode($res)->items;

        return $videos;
    }

    public function getChannelByUsername($username) {
        $url = $this->urlBuilder
            ->path('channels')
            ->params([
                'part' => 'contentDetails',
                'forUsername' => $username
            ])
            ->build();

        $res = $this->http->get($url);

        $channel = json_decode($res)->items[0];

        return $channel;
    }

    public function videoSearch($data=[]) {

    }

    public function getVideo($data) {
        return $this->getVideos($data, ['includeChannel' => true])->first();
    }

    private function parseDuration($duration) {
        $parsedDuration = '';

        $parts = null;

        preg_match_all('/(\d+)/', $duration, $parts);

        $times = $parts[0];

        if (count($times) === 3) {
            $parsedDuration = $times[0] . ':' . $this->padTime($times[1]) . ':' . $this->padTime($times[2]);
        } else if (count($times) === 2) {
            $parsedDuration = $times[0] . ':' . $this->padTime($times[1]);
        } else if (count($times) === 1) {
            $parsedDuration = '0:' . $this->padTime($times[0]);
        }

        return $parsedDuration;
    }

    private function padTime($time) {
        $padded = '';

        if (strlen($time) < 2) {
            for($i = strlen($time); $i < 2; $i ++) {
                $padded .= '0';
            }
        }

        $padded .= $time;

        return $padded;
    }

}
