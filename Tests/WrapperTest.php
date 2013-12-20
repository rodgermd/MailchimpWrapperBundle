<?php
/**
 * Created by PhpStorm.
 * User: rodger
 * Date: 20.12.13
 * Time: 10:37
 */

namespace Rodgermd\MailchimpWrapperBundle\Tests;


use Rodgermd\MailchimpWrapperBundle\Model\Base\EmailStructure;
use Rodgermd\MailchimpWrapperBundle\Model\Base\ListMemberOptions;
use Rodgermd\MailchimpWrapperBundle\Model\SubscribeModel;
use Rodgermd\MailchimpWrapperBundle\Wrapper\APIWrapper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;
use \Mailchimp_ValidationError;

/**
 * Class WrapperTest
 * Testing wrapper
 *
 * @package Rodgermd\MailchimpWrapperBundle\Test
 */
class WrapperTest extends WebTestCase
{
    /** @var  Container */
    protected $container;
    /** @var  APIWrapper */
    protected $wrapper;

    /**
     * Set up the test
     */
    public function setUp()
    {
        $this->container = static::createClient()->getContainer();
        $this->wrapper   = $this->container->get('rodgermd.mailchimp');
    }

    /**
     * Test subscribe fail
     * Should get Mailchimp_ValidationError
     */
    public function testSubscribeFail()
    {

        $email = 'test@example.com';
        $this->setExpectedException('Mailchimp_ValidationError');

        $this->wrapper->subscribe(new SubscribeModel($email));
    }

    /**
     * Test subscribe success
     */
    public function testSubscribeSuccess()
    {

        $email                 = 'rodger@ladela.com';
        $model                 = new SubscribeModel($email);
        $model->doubleOptin    = false;
        $model->updateExisting = true;
        $result                = $this->wrapper->subscribe($model);

        $this->assertTrue($result instanceof EmailStructure);
        $this->assertEquals($email, $result->email);
        $this->assertNotNull($result->euid);
        $this->assertNotNull($result->leid);

        // email should be already in the list

        $subscribers = $this->wrapper->listSubscribers(new ListMemberOptions());

        $emails = array();
        array_map(
            function ($s) use (&$emails) {
                $emails[] = $s['email'];
            },
            $subscribers
        );

        $this->assertTrue(in_array($email, $emails));
    }
}