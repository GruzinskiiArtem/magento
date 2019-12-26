<?php

namespace Itransition\Blog\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;

/**
 * Class Router
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Router constructor.
     *
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request): ?ActionInterface
    {
        $uri = trim($request->getPathInfo(), '/');
        $data = explode('/', $uri);

        if ($data[0] === 'blog') {
            $request->setModuleName('itrblog');
            $request->setControllerName('post');

            if (!empty($data[1]) && !isset($data[2])) {
                $request->setActionName('view');
                $request->setParams([
                    'identifier' => $data[1],
                ]);
            } else {
                $request->setActionName('index');
            }

            return $this->actionFactory->create(Forward::class, ['request' => $request]);
        }

        return null;
    }
}