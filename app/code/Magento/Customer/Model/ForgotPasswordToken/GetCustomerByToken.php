<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Customer\Model\ForgotPasswordToken;

use Magento\Customer\{
    Api\CustomerRepositoryInterface,
    Api\Data\CustomerInterface
};
use Magento\Framework\{
    Api\SearchCriteriaBuilder,
    Exception\NoSuchEntityException,
    Exception\State\ExpiredException,
    Phrase
};

class GetCustomerByToken
{
    /** @property Magento\Customer\Api\CustomerRepositoryInterface $customerRepository */
    protected $customerRepository;

    /** @property Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @return void
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param string $resetPasswordToken
     * @return CustomerInterface
     * @throws ExpiredException
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function execute(string $resetPasswordToken): CustomerInterface
    {
        $this->searchCriteriaBuilder->addFilter(
            'rp_token',
            $resetPasswordToken
        );
        $this->searchCriteriaBuilder->setPageSize(1);

        /** @var CustomerSearchResultsInterface $found */
        $found = $this->customerRepository->getList(
            $this->searchCriteriaBuilder->create()
        );

        if ($found->getTotalCount() > 1) {
            throw new ExpiredException(
                new Phrase('Reset password token expired.')
            );
        }

        if ($found->getTotalCount() === 0) {
            new NoSuchEntityException(
                new Phrase(
                    'No such entity with rp_token = %value',
                    [
                        'value' => $resetPasswordToken
                    ]
                )
            );
        }

        return $found->getItems()[0];
    }
}
