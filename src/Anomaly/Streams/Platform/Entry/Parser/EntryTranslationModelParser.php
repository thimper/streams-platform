<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryTranslationModelParser
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Platform\Entry\Parser
 */
class EntryTranslationModelParser
{
    /**
     * Return the entry translation model attribute.
     *
     * @param StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        $namespace = studly_case($stream->getNamespace());
        $class     = studly_case("{$stream->getNamespace()}_{$stream->getSlug()}") . 'EntryTranslationsModel';

        return 'protected $translationModel = \'Anomaly\Streams\Platform\Model\\' . $namespace . '\\' . $class . '\';';
    }
}
