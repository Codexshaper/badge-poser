<?php

/*
 * This file is part of the badge-poser package.
 *
 * (c) PUGX <http://pugx.github.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Badge\Model\UseCase;

use App\Badge\Model\Badge;
use App\Badge\Model\Package;
use App\Badge\Model\PackageRepositoryInterface;
use App\Badge\Service\NormalizerInterface;
use App\Badge\Service\TextNormalizer;

/**
 * Create the 'suggesters' image with the standard Font and standard Image.
 */
class CreateSuggestersBadge extends BaseCreatePackagistImage
{
    public const COLOR = '007ec6';
    public const SUBJECT = 'suggesters';

    /**
     * @var NormalizerInterface
     */
    private $normalizer;

    /**
     * @param NormalizerInterface $textNormalizer
     */
    public function __construct(
        PackageRepositoryInterface $packageRepository,
        NormalizerInterface $textNormalizer = null
    ) {
        parent::__construct($packageRepository);
        $this->normalizer = $textNormalizer ?? new TextNormalizer();
    }

    public function createSuggestersBadge(string $repository, string $format = 'svg'): Badge
    {
        return $this->createBadgeFromRepository($repository, self::SUBJECT, self::COLOR, $format);
    }

    /**
     * @param string|null $context
     *
     * @return string
     */
    protected function prepareText(Package $package, $context = null)
    {
        $suggesters = $package->getSuggesters();
        if (0 === $suggesters) {
            return '0';
        }

        return $this->normalizer->normalize($suggesters);
    }
}
