<?php
namespace Magneto\AdminResetPassword\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\CustomerRegistry;
use Magento\Framework\Encryption\EncryptorInterface as Encryptor;

class AccountManagement
{
    protected $customerRepository;
    
    protected $customerRegistry;
    
    protected $encryptor;
    
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        CustomerRegistry $customerRegistry,
        Encryptor $encryptor
    ) {
        $this->customerRepository = $customerRepository;
        $this->customerRegistry = $customerRegistry;
        $this->encryptor = $encryptor;
    }

    public function changePasswordById($customerId, $password)
    {
        $customer = $this->customerRepository->getById($customerId);
        $customerSecure = $this->customerRegistry->retrieveSecureData($customer->getId());
        $customerSecure->setRpToken(null);
        $customerSecure->setRpTokenCreatedAt(null);
        $passwordHash = $this->encryptor->getHash($password, true);
        $customerSecure->setPasswordHash($passwordHash);
        $this->customerRepository->save($customer);
    }
}
