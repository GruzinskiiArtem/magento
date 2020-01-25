<?php

namespace Itransition\Blog\Observer;

use Magento\Framework\Event\ObserverInterface;
use Itransition\Blog\Helper\Email;
use Itransition\Blog\Model\Post;
use Magento\Framework\Event\Observer;

class NewPostObserver implements ObserverInterface
{
    /**
     * @var Email
     */
    private $emailHelper;

    /**
     * NewPostObserver constructor.
     * @param Email $emailHelper
     */
    public function __construct(Email $emailHelper)
    {
        $this->emailHelper = $emailHelper;
    }

    public function execute(Observer $observer)
    {
        $post = $observer->getPost();
        if ($post->isObjectNew()) {
            $this->emailHelper->notify('a.gruzinsky@itransition.com', 'Test');
        }
    }
}
