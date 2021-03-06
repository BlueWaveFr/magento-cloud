<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/** @var $permission \Magento\CatalogPermissions\Model\Permission */
$permission = \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->create(
    'Magento\CatalogPermissions\Model\Permission'
);
$permission->setEntityId(
    1
)->setWebsiteId(
    \Magento\TestFramework\Helper\Bootstrap::getObjectManager()->get(
        'Magento\Store\Model\StoreManagerInterface'
    )->getWebsite()->getId()
)->setCategoryId(
    3
)->setCustomerGroupId(
    1
)->setGrantCatalogCategoryView(
    \Magento\CatalogPermissions\Model\Permission::PERMISSION_DENY
)->setGrantCatalogProductPrice(
    \Magento\CatalogPermissions\Model\Permission::PERMISSION_DENY
)->setGrantCheckoutItems(
    \Magento\CatalogPermissions\Model\Permission::PERMISSION_DENY
)->save();
