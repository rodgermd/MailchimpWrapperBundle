<?php
/**
 * Created by PhpStorm.
 * User: rodger
 * Date: 20.12.13
 * Time: 11:14
 */

namespace Rodgermd\MailchimpWrapperBundle\Model\Base;

/**
 * Class ListMemberOptions
 * Defines options for list/members request
 *
 * @package Rodgermd\MailchimpWrapperBundle\Model\Base
 */
class ListMemberOptions
{
    public $start = 0;
    public $limit = 25;
    public $sortField;
    public $sortDir = 'ASC';
    public $segment;
    public $status;

    /**
     * Gets array of request options
     *
     * @return array
     */
    public function getOptions()
    {
        return array(
            'start'      => $this->start,
            'limit'      => $this->limit,
            'sort_field' => $this->sortField,
            'sort_dir'   => $this->sortDir,
            'segment'    => $this->segment
        );
    }
}