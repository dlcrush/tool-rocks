<?php

namespace App\Repositories\Contracts;

interface BandRepository {
    public function getBand($bandIdOrSlug);
    public function getBands();
    public function getSong($bandIdOrSlug='tool', $songIdOrSlug);
    public function getTours($bandIdOrSlug);
    public function getTour($bandIdOrSlug, $tourId);
    public function getShow($bandIdOrSlug, $tourId, $showId);
}
