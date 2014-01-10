<?php
/**
 * Created by PhpStorm.
 * User: rodger
 * Date: 20.12.13
 * Time: 10:01
 */

namespace Rodgermd\MailchimpWrapperBundle\Wrapper;

use \Mailchimp;
use Rodgermd\MailchimpWrapperBundle\Exception\MailchimpAPIException;
use Rodgermd\MailchimpWrapperBundle\Model\Base\EmailStructure;
use Rodgermd\MailchimpWrapperBundle\Model\Base\ListMemberOptions;
use Rodgermd\MailchimpWrapperBundle\Model\SubscribeModel;

/**
 * Class APIWrapper
 * Wraps mailchimp native API
 *
 * @package Rodgermd\MailchimpWrapperBundle\Wrapper
 */
class APIWrapper
{
    /** @var \Mailchimp */
    protected $api;
    /** @var string */
    protected $defaultListId;
    /** @var string */
    protected $defaultFromEmail;

    /**
     * Object constructor
     *
     * @param string $apiKey
     * @param string $defaultListId
     * @param string $defaultFromEmail
     */
    public function __construct($apiKey, $defaultListId, $defaultFromEmail)
    {
        $this->api              = new Mailchimp($apiKey);
        $this->defaultListId    = $defaultListId;
        $this->defaultFromEmail = $defaultFromEmail;
    }

    /**
     * Subscribes single email to a list
     *
     * @param SubscribeModel $model
     * @param string         $listId
     *
     * @return EmailStructure
     */
    public function subscribe(SubscribeModel $model, $listId = null)
    {
        $result = $this->api->lists->subscribe(
            $listId ? : $this->defaultListId,
            $model->email->toArray(),
            $model->mergeVars,
            $model->emailType,
            $model->doubleOptin,
            $model->updateExisting,
            $model->replaceInterests,
            $model->sendWelcome
        );

        return new EmailStructure($result['email'], $result['euid'], $result['leid']);
    }

    /**
     * Subscribe email
     *
     * @param string $email
     * @param string $listId
     *
     * @return EmailStructure
     */
    public function subscribeEmail($email, $listId = null)
    {
        return $this->subscribe(new SubscribeModel($email), $listId);
    }

    /**
     * Gets list subscribers
     *
     * @param ListMemberOptions $options
     * @param string            $listId
     *
     * @return array
     */
    public function listSubscribers(ListMemberOptions $options, $listId = null)
    {
        $subscribers = array();
        $result      = $this->api->lists->members($listId ? : $this->defaultListId, $options->status, $options->getOptions());
        foreach ($result['data'] as $subscriber) {
            $subscribers[] = $subscriber;
        }

        return $subscribers;
    }

    /**
     * Creates campaign
     *
     * @param string $subject
     * @param string $content
     * @param string $title - optional
     *
     * @return array
     *
     * @throws \Rodgermd\MailchimpWrapperBundle\Exception\MailchimpAPIException
     */
    public function createCampaign($subject, $content, $title = null)
    {
        try {
            return $this->api->campaigns->create(
                'regular',
                array(
                    'title'         => $title ? : $subject,
                    'subject'       => $subject,
                    'list_id'       => $this->defaultListId,
                    'from_email'    => $this->defaultFromEmail['email'],
                    'from_name'     => $this->defaultFromEmail['name'],
                    'generate_text' => true
                ),
                array('html' => $content)
            );
        } catch (\Mailchimp_Error $e) {
            throw new MailchimpAPIException($e->getMessage(), $e->getCode(), $e);
        }
    }
} 