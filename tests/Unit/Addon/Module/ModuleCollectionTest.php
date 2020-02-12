<?php

use Tests\TestCase;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

class ModuleCollectionTest extends TestCase
{

    public function testSearch()
    {
        $addons = app(ExtensionCollection::class);

        $this->assertTrue($addons->search('anomaly.module.users::authenticator.*')->isNotEmpty());
    }
}
