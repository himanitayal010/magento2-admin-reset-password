<?php
namespace Magneto\AdminResetPassword\Controller\Adminhtml\Customer;

use Magento\Backend\App\Action\Context;
use Magneto\AdminResetPassword\Model\AccountManagement;
use Magento\Framework\Controller\ResultFactory;

class Changepassword extends \Magento\Backend\App\Action
{
    protected $accountManagement;

    public function __construct(
        Context $context,
        AccountManagement $accountManagement
    ) {
        $this->accountManagement = $accountManagement;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $customerId = $this->getRequest()->getParam('customer_id');
            $password = $this->getRequest()->getParam('password');
            if (!$customerId) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Customer ID should be specified.')
                );
            }
            if (!$password) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Please enter password.')
                );
            }
            $this->accountManagement->changePasswordById($customerId, $password);
            $result = ['error' => 0, 'message' => 'Password has been updated.'];
        } catch (\Exception $e) {
            $result = ['error' => 1, 'message' => $e->getMessage()];
        }
        
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $resultJson->setData($result);
    }
}
