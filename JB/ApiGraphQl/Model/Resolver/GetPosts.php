<?php

namespace JB\ApiGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;


class GetPosts implements ResolverInterface
{
    public function __construct(
        \JB\ApiGraphQl\Model\Resolver\DataProvider\PostDataProvider $postDataProvider
    ){
        $this->postDataProvider = $postDataProvider;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        $postData = $this->postDataProvider->getPosts();
        return $postData;
    }
}