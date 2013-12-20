<?php
/**
 * Created by PhpStorm.
 * User: rodger
 * Date: 20.12.13
 * Time: 10:17
 */

namespace Rodgermd\MailchimpWrapperBundle\Model;

use Rodgermd\MailchimpWrapperBundle\Model\Base\EmailStructure;

/**
 * Class SubscribeModel
 * Single email subscribe model
 *
 * @package Rodgermd\MailchimpWrapperBundle\Model
 */
class SubscribeModel
{
    /** @var EmailStructure */
    public $email;
    /** @var array */
    public $mergeVars = array();
    /** @var string */
    public $emailType = 'html';
    /** @var bool */
    public $doubleOptin = true;
    /** @var bool */
    public $updateExisting = false;
    /** @var bool */
    public $replaceInterests = true;
    /** @var bool */
    public $sendWelcome = false;

    /**
     * Object constructor
     *
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = new EmailStructure($email);
    }

} 