<?php

namespace Itransition\Blog\Controller\Post;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Itransition\Blog\Model\PostRepository;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class View extends Action implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @var PostRepository
     */
    private $postRepository;

    private $registry;

    /**
     * Index constructor.
     * @param Context $context
     * @param PostRepository $postRepository
     * @param PageFactory $pageFactory
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        PostRepository $postRepository,
        PageFactory $pageFactory,
        Registry $registry
    ) {
        $this->postRepository = $postRepository;
        $this->pageFactory = $pageFactory;
        $this->registry = $registry;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|Page
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $this->registry->register(
            'current_post',
            $this->postRepository->getByIdentifier($this->getRequest()->getParam('identifier', null))
        );

        return $this->pageFactory->create();
    }
}
