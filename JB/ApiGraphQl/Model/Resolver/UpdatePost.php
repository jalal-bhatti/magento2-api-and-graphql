<?php

namespace JB\ApiGraphQl\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class UpdatePost implements ResolverInterface
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
        $msg = "";
        try {
            $entity_id = $args['input']['entity_id'];
            $postTitle = $args['input']['title'];
            $postDescription = $args['input']['description'];
            $postCategories = $args['input']['categories'];
            $postCreatedAt = $args['input']['created_at'];
            $postUpdatedAt = $args['input']['updated_at'];
            $msg =  $this->postDataProvider->updatePost($entity_id,$postTitle,$postDescription,$postCategories,$postCreatedAt,$postUpdatedAt);
        } catch(\Exception $e){
            $msg = $e;
        }
        return $msg;
    }
}