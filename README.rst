Backport Magento classes and interface for older versions.

.. contents:: :local:

Description
===========

``AuroraExtensions_MagentoBackports`` backports ``Magento`` classes, interfaces, configurations,
etc. from newly released versions for use in older versions of Magento. This allows an extension
developer to leverage newer Magento features without having to stress quite as much about issues
around upgrades and version compatibility.

Installation
============

.. code-block:: sh

    composer require auroraextensions/magentobackports

Backports
=========

Classes
-------

.. |backport1| replace:: ``Magento\Customer\Model\ForgotPasswordToken\ConfirmCustomerByToken``
.. |backport2| replace:: ``Magento\Customer\Model\ForgotPasswordToken\GetCustomerByToken``

.. _backport1: https://github.com/auroraextensions/magentobackports/blob/master/src/Customer/Model/ForgotPasswordToken/ConfirmCustomerByToken.php
.. _backport2: https://github.com/auroraextensions/magentobackports/blob/master/src/Customer/Model/ForgotPasswordToken/GetCustomerByToken.php

* |backport1|_
* |backport2|_

Contribution
============

Keeping the above in mind, please understand this is *not* an absolute, comprehensive collection
of backports, but rather a valiant effort toward improving Magento extension compatibility. It is
highly recommended to review and verify this module contains the relevant backports before adding
it as a dependency. If you would like to see a backport added, please do either of the following:

* Send PR with the missing backport
   
*--OR--*

* Open an issue to let us know so we can review
