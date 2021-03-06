<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\GiftCardAccount\Test\Fixture\GiftCardAccount;

use Magento\Mtf\Fixture\DataSource;
use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Store\Test\Fixture\Website;

/**
 * Prepare data for website_id field in reward rate fixture.
 *
 * Data keys:
 *  - dataset
 */
class WebsiteId extends DataSource
{
    /**
     * Website fixture.
     *
     * @var Website
     */
    protected $website;

    /**
     * @param FixtureFactory $fixtureFactory
     * @param array $params
     * @param array $data
     */
    public function __construct(FixtureFactory $fixtureFactory, array $params, $data = [])
    {
        $this->params = $params;
        if (isset($data['dataset'])) {
            /** @var Website $website */
            $website = $fixtureFactory->createByCode('website', ['dataset' => $data['dataset']]);
            if (!$website->hasData('website_id')) {
                $website->persist();
            }
            $this->website = $website;
            $this->data = $website->getName();
        } elseif (isset($data['source']) && $data['source'] instanceof Website) {
            $this->website = $data['source'];
            $this->data = $data['source']->getName();
        }
    }

    /**
     * Return website fixture
     *
     * @return Website
     */
    public function getWebsite()
    {
        return $this->website;
    }
}
