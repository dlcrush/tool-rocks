<?php

namespace App\Repositories\Contracts;

interface BandRepository {
    public function getBand($bandIdOrSlug);
    public function getBands();
    public function getSong($bandIdOrSlug='tool', $songIdOrSlug);
}
