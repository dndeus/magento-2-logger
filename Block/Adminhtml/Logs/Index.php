<?php


namespace Dndeus\Logger\Block\Adminhtml\Logs;

/**
 * Class Index
 *
 * @package Dndeus\Logger\Block\Adminhtml\Logs
 */
class Index extends \Magento\Backend\Block\Template
{

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
}

