<?php
/******************************************************
 * @package Magento 2 Membership
 * @author http://www.magefox.com
 * @copyright (C) 2018 - Magefox.Com
 * @license MIT
 *******************************************************/

namespace Magefox\Membership\Setup;

class Uninstall implements \Magento\Framework\Setup\UninstallInterface
{
    /**
     * EAV setup factory
     *
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @inheritDoc
     */
    public function uninstall(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $setup->startSetup();

        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // Remove product attributes
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'membership_length');
        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'membership_length_unit');

        // Remove customer attributes
        $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, 'membership_expiry');
        $eavSetup->removeAttribute(\Magento\Customer\Model\Customer::ENTITY, 'membership_order_id');

        $setup->endSetup();
    }

}
