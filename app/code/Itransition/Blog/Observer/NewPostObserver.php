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
        /** @var Post  $post */
        $post = $observer->getData('post');
        $this->emailHelper->notify($post->getTitle(), $post->getCreationTime());
    }
}
