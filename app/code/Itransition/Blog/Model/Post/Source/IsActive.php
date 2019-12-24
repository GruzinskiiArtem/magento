<?php

namespace Itransition\Blog\Model\Post\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Itransition\Blog\Model\Post;

class IsActive implements OptionSourceInterface
{
    /**
     * @var Post
     */
    protected $cmsPage;

    /**
     * Constructor
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->post->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
