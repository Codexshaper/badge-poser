<?php

/*
 * This file is part of the badge-poser package.
 *
 * (c) PUGX <http://pugx.github.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use Packagist\Api\Client as PackagistClient;
use Packagist\Api\Result\Result as PackagistResult;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SearchPackagistController.
 *
 * @author Giulio De Donato <liuggio@gmail.com>
 * @author Leonardo Proietti <leonardo.proietti@gmail.com>
 * @author Simone Fumagalli <simone@iliveinperego.com>
 * @author Andrea Giuliano <giulianoand@gmail.com>
 * @author Andrea Giannantonio <a.giannantonio@gmail.com>
 */
class PackagistController extends Controller
{
    /**
     * @param Request $request
     * @param PackagistClient $packagistClient
     * @return JsonResponse
     */
    public function search(Request $request, PackagistClient $packagistClient): JsonResponse
    {
        $responseContent = array();
        $packageName = $request->query->get('name');

        $packagistResponse = $packagistClient->search($packageName);

        /** @var PackagistResult $package */
        foreach ($packagistResponse as $package) {
            $responseContent[] = array('id' => $package->getName(), 'description' => $package->getDescription());
        }

        return new JsonResponse($responseContent);
    }
}