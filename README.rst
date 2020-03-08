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

.. _diff: https://github.com/auroraextensions/magentobackports/blob/master/diff

Backports are grouped by version in the `diff`_ directory.

FAQs
====

    Why not simply upgrade the platform?

| Each merchant operates differently and often has vastly different requirements. Particularly
| for large merchants, upgrading Magento can be cumbersome and risky for myriad reasons, like
| new and/or incompatible dependencies, deprecation and/or removal of required functionality,
| and much more. These issues can result in significant downtime and serious loss in revenue,
| so it requires substantial time commitment to ensure the process goes accordingly.
|
| ``AuroraExtensions_MagentoBackports`` fills an important void by providing dependent functionality
| ex post facto, allowing merchants to upgrade and use the latest versions of their third-party modules
| without the significant time commitment and inherent risk that comes with platform upgrades.

|

    What happens if our Magento version provides one of the backported classes?

| Composer will use the original version if it is available, or the backported version if not.

|

    Are the backported classes different from the original classes provided by Magento?

| In terms of functionality, no, they are 100% equivalent. However, we may elect to clean up
| the source code for several reasons, such as performance and/or readability.

Contribution
============

Keeping the above in mind, please understand this is *not* an absolute, comprehensive collection
of backports, but rather a valiant effort toward improving Magento extension compatibility. It is
highly recommended to review and verify this module contains the relevant backports before adding
it as a dependency. If you would like to see a backport added, please do either of the following:

* Send PR with the missing backport
   
**--OR--**

* Open an issue to let us know so we can review
