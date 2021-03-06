<?php

/*
 * This file is part of the badge-poser package.
 *
 * (c) PUGX <http://pugx.github.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Controller\Badge;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ComposerLockControllerTest.
 */
class ComposerLockControllerTest extends WebTestCase
{
    public function testComposerLockAction(): void
    {
        $client = static::createClient();
        $client->request('GET', '/pugx/badge-poser/composerlock');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testComposerLockSvgExplicit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/pugx/badge-poser/composerlock.svg');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
