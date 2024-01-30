<?php

namespace Dkacevich\MedialibraryNamers\Path;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class SeparatedByModelPathGenerator implements PathGenerator
{

    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsive-images/';
    }

    protected function getBasePath(Media $media): string
    {

        $collection_path = $media->collection_name === 'default' ? '' : $media->collection_name . '/';

        $modelType = Str::of($media->getMorphClass())
            ->explode("\\")
            ->last();
        
        $modelType = mb_strtolower($modelType);


        return "$modelType/$collection_path{$media->model_id}/{$media->getKey()}";
    }

}
