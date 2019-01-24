<?php
namespace Magneto\AdminResetPassword\Block\Adminhtml\Edit;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;

class NewPasswordButton extends GenericButton implements ButtonProviderInterface
{
    protected $customerAccountManagement;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        AccountManagementInterface $customerAccountManagement
    ) {
        parent::__construct($context, $registry);
        $this->customerAccountManagement = $customerAccountManagement;
    }

    public function getButtonData()
    {
        $customerId = $this->getCustomerId();
        $canModify = $customerId && !$this->customerAccountManagement->isReadonly($this->getCustomerId());
        $data = [];
        if ($customerId && $canModify) {
            $data = [
                'label' => __('Reset Password'),
                'class' => 'change-password',
                'id' => 'magneto-adminresetpassword-newpassword-button',
                'data_attribute' => [
                    'mage-init' => ['Magneto_AdminResetPassword/js/changepassword' => [
                        'saveUrl' => $this->getSaveUrl()
                    ]]
                ],
                'on_click' => '',
                'sort_order' => 60,
            ];
        }
        return $data;
    }

    public function getSaveUrl()
    {
        return $this->getUrl('adminresetpassword/customer/changepassword', ['customer_id' => $this->getCustomerId()]);
    }
}
