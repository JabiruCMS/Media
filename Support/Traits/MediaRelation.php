<?php

namespace Modules\Media\Support\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Modules\Media\Entities\File;

/**
 * @property Collection<File> $files
 */
trait MediaRelation
{
    /**
     * Make the Many To Many Morph To Relation
     * @return object|MorphToMany
     */
    public function files(): MorphToMany
    {
        return $this->morphToMany(File::class, 'imageable', 'media__imageables')->withPivot('zone', 'id')->withTimestamps()->orderBy('order');
    }

    /**
     * Make the Many to Many Morph to Relation with specific zone
     * @param string $zone
     * @return object
     */
    public function filesByZone($zone)
    {
        return $this->morphToMany(File::class, 'imageable', 'media__imageables')
            ->withPivot('zone', 'id')
            ->wherePivot('zone', '=', $zone)
            ->withTimestamps()
            ->orderBy('order');
    }
}
