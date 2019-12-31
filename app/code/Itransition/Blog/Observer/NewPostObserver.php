<?php

namespace Itransition\Blog\Observer;

use Magento\Framework\Event\ObserverInterface;
use Itransition\Blog\Helper\Email;
use Itransition\Blog\Model\Post;

class NewPostObserver implements ObserverInterface
{
    /**
     * @var Email
     */
    private $emailHelper;

    public function __construct(Email $emailHelper)
    {
        $this->emailHelper = $emailHelper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $post = $observer->getPost();
        $this->emailHelper->notify('a.gruzinsky@itransition.com', 'Test');
    }
}
