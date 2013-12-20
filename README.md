MailchimpWrapperBundle
======================

1. Install
----------

composer.json:

~~~
"rodgermd/mailchimp2-wrapper-bundle": "dev-master"
~~~

AppKernel.php:

~~~
new Rodgermd\MailchimpWrapperBundle\RodgermdMailchimpWrapperBundle(),
~~~


2. Configure
------------

Required options:

~~~
rodgermd_mailchimp_wrapper:
  api_key         :  %mailchimp.apikey%   # api key of your mailchimp account
  default_list_id :  %mailchimp.listid%   # default list id
~~~
