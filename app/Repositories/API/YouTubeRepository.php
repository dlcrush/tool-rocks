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
        $this->apiKey = $apiKey;
    }

    public function getVideos($data=[], $options=[]) {
        if (! is_array($data)) {
            $data = ['id' => $data];
        }

        $includeChannel = array_key_exists('includeChannel', $options) ? $options['includeChannel'] == true : false;
        $includeChannel = true;

        $params = array_merge([
            'part' => 'snippet,statistics'
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

            $video->title = $snippet->title;
            $video->description = $snippet->description;
            $video->id = $v->id;
            $video->channelId = $snippet->channelId;
            $video->images = $snippet->thumbnails;
            $video->views = $statistics->viewCount;
            $video->thumbsUp = $statistics->likeCount;
            $video->thumbsDown = $statistics->dislikeCount;
            if ($includeChannel) {
                $video->channel = $this->getChannelById($video->channelId);
            }

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

    }

    public function getChannelById($id) {

        $url = $this->urlBuilder
            ->path('channels')
            ->params([
                'part' => 'snippet,statistics',
                'id' => $id
            ])
            ->build();

        $res = $this->http->get($url);

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

}
