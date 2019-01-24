<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magneto\AdminResetPassword\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class ResetPasswordButton
 */
class ResetPasswordButton extends \Magento\Customer\Block\Adminhtml\Edit\ResetPasswordButton
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $customerId = $this->getCustomerId();
        // $data = [];
        // if ($customerId) {
        //     $data = [
        //         'label' => __('Reset Password'),
        //         'class' => 'reset reset-password',
        //         'on_click' => sprintf("location.href = '%s';", $this->getResetPasswordUrl()),
        //         'sort_order' => 60,
        //     ];
        // }
        // return $data;
    }

    /**
     * @return string
     */
    public function getResetPasswordUrl()
    {
        return $this->getUrl('adminresetpassword/customer/changepassword', ['customer_id' => $this->getCustomerId()]);
    }
}
