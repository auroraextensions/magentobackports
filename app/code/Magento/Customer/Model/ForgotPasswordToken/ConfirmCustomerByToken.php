<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Customer\Model\ForgotPasswordToken;

use Magento\Customer\{
    Api\CustomerRepositoryInterface,
    Model\ForgotPasswordToken\GetCustomerByToken
};

class ConfirmCustomerByToken
{
    /** @property GetCustomerByToken $getByToken */
    private $getByToken;

    /** @property CustomerRepositoryInterface $customerRepository */
    private $customerRepository;

    /**
     * @param GetCustomerByToken $getByToken
     * @param CustomerRepositoryInterface $customerRepository
     * @return void
     */
    public function __construct(
        GetCustomerByToken $getByToken,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->getByToken = $getByToken;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param string $resetPasswordToken
     * @return void
     * @throws Magento\Framework\Exception\LocalizedException
     */
    public function execute(string $resetPasswordToken): void
    {
        /** @var CustomerInterface $customer */
        $customer = $this->getByToken
            ->execute($resetPasswordToken);

        if ($customer->getConfirmation()) {
            $this->customerRepository->save(
                $customer->setConfirmation(null)
            );
        }
    }
}
