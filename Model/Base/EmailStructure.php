<?php
/**
 * Created by PhpStorm.
 * User: rodger
 * Date: 20.12.13
 * Time: 10:27
 */

namespace Rodgermd\MailchimpWrapperBundle\Model\Base;

/**
 * Class EmailStructure
 * Mailchimp email structure
 *
 * @package Rodgermd\MailchimpWrapperBundle\Model
 */
class EmailStructure
{
    /** @var string */
    public $email;
    /** @var string */
    public $euid;
    /** @var string */
    public $leid;

    /**
     * Object constructor
     *
     * @param string $email
     * @param string $euid
     * @param string $leid
     */
    public function __construct($email, $euid = null, $leid = null)
    {
        $this->email = $email;
        $this->euid  = $euid;
        $this->leid  = $leid;
    }

    /**
     * Array representation
     *
     * @return array
     */
    public function toArray()
    {
        return array('email' => $this->email, 'euid' => $this->euid, 'leid' => $this->leid);
    }
} 