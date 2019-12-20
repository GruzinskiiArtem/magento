<?php

namespace Itransition\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Itransition\Blog\Model\Post;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Itransition\Blog\Api\PostRepositoryInterface;
use Magento\Framework\Controller\ResultInterface;
use Itransition\Blog\Api\Data\PostInterface;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\View\Result\PageFactory;

/**
 * Save CMS page action.
 */
class Save extends Action implements HttpPostActionInterface
{

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Itransition\Blog\Model\PostFactory
     */
    private $postFactory;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     * @param \Itransition\Blog\Model\PostFactory|null $postFactory
     * @param PostRepositoryInterface|null $postRepository
     */
    public function __construct(
        Action\Context $context,
        PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor,
        \Itransition\Blog\Model\PostFactory $postFactory = null,
        PostRepositoryInterface $postRepository = null
    ) {
        $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->dataProcessor->filter($data);
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = Post::IS_ACTIVE;
            }
            if (empty($data['post_id'])) {
                $data['post_id'] = null;
            }

            /** @var Post $model */
            $model = $this->postFactory->create();

            $id = $this->getRequest()->getParam('post_id');
            if ($id) {
                try {
                    $model = $this->postRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This post no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->postRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                return $this->processResultRedirect($model, $resultRedirect, $data);
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
            }

            $this->dataPersistor->set('blog_post', $data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process result redirect
     *
     * @param PostInterface $model
     * @param Redirect $resultRedirect
     * @param array $data
     * @return Redirect
     * @throws LocalizedException
     */
    private function processResultRedirect($model, $resultRedirect, $data)
    {
        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
            $newPage = $this->postFactory->create(['data' => $data]);
            $newPage->setId(null);
            $identifier = $model->getIdentifier() . '-' . uniqid();
            $newPage->setIdentifier($identifier);
            $newPage->setIsActive(false);
            $this->postRepository->save($newPage);
            $this->messageManager->addSuccessMessage(__('You duplicated the post.'));
            return $resultRedirect->setPath(
                '*/*/edit',
                [
                    'post_id' => $newPage->getId(),
                    '_current' => true
                ]
            );
        }
        $this->dataPersistor->clear('blog_post');
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $model->getId(), '_current' => true]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
