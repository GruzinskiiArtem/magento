<?php

namespace Itransition\Blog\Model;

use Itransition\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Itransition\Blog\Model\Post\ImageUploader;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;

class Post extends AbstractModel implements PostInterface, IdentityInterface
{

    const CACHE_TAG = 'itransition_blog_post';

    protected $_cacheTag = 'itransition_blog_post';

    protected $_eventPrefix = 'itransition_blog_post';

    protected $_eventObject = 'post';

    const STATUS_ENABLED = 1;

    const STATUS_DISABLED = 0;

    /**
     * @var ImageUploader
     */
    private $imageUploaderge;

    /**
     * @var string
     */
    protected $_idFieldName = self::POST_ID;

    protected function _construct()
    {
        $this->_init(ResourceModel\Post::class);
    }

    /**
     * Post constructor.
     * @param Context $context
     * @param Registry $registry
     * @param ImageUploader $imageUploaderge
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ImageUploader $imageUploaderge,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        $this->imageUploaderge = $imageUploaderge;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @return string
     */
    public function getIdentities(): string
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->getData(self::POST_ID);
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreationTime(): string
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateTime(): string
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Get is active
     *
     * @return bool
     */
    public function getIsActive(): bool
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return PostInterface
     */
    public function setId($id): PostInterface
    {
        return $this->setData(self::POST_ID, $id);
    }

    /**
     * Set title
     *
     * @param string $title
     * @return PostInterface
     */
    public function setTitle($title): PostInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PostInterface
     */
    public function setContent($content): PostInterface
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return PostInterface
     */
    public function setIdentifier($identifier): PostInterface
    {
        return $this->setData(self::IDENTIFIER, $identifier);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return PostInterface
     */
    public function setCreationTime($creationTime): PostInterface
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return PostInterface
     */
    public function setUpdateTime($updateTime): PostInterface
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Set is active
     *
     * @param int|bool $isActive
     * @return PostInterface
     */
    public function setIsActive($isActive): PostInterface
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Prepare banner's statuses.
     *
     * @return array
     */
    public function getAvailableStatuses(): array
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->getData(self::IMAGE_NAME);
    }

    /**
     * @param string $imageName
     * @return string|null
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getImageUrl($imageName): ?string
    {
        return $this->imageUploaderge->getImageUrl($imageName);
    }

    /**
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->getData(self::PRODUCT_ID);
    }
}
