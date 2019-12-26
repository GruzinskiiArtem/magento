<?php

namespace Itransition\Blog\Block\Post;

use Itransition\Blog\Model\Post;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Itransition\Blog\Model\Post\ImageUploader;
use Magento\Framework\UrlInterface;

class View extends Template
{
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var ImageUploader
     */
    private $imageUploader;
    /**
     * @var UrlInterface
     */
    private $url;

    public function __construct(Template\Context $context, Registry $registry, ImageUploader $imageUploader, UrlInterface $url, array $data = [])
    {
        $this->url = $url;
        $this->imageUploader = $imageUploader;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return Post
     */
    private function getPost()
    {
        return $this->registry->registry('current_post');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getPost()->getTitle();
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrl()
    {
        return $this->url->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) .
            $this->imageUploader->getFilePath($this->imageUploader->getBaseTmpPath(), $this->getPost()->getImageUrl());
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getPost()->getContent();
    }

    /**
     * @return string
     */
    public function getCreationTime()
    {
        return $this->getPost()->getCreationTime();
    }
}
