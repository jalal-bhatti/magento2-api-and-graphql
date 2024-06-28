<?php

namespace JB\ApiGraphQl\Model\Resolver\DataProvider;

class PostDataProvider
{
   /**
   * @param
   */
    public function __construct(
        \JB\ApiGraphQl\Model\PostFactory $postApiFactory,
        \JB\ApiGraphQl\Model\ResourceModel\Post\CollectionFactory $postCollectionFactory
    ) {
        $this->postApiFactory = $postApiFactory;
        $this->postCollectionFactory = $postCollectionFactory;
    }

    public function getPosts()
    {   
        try {
            $postCollections = $this->postCollectionFactory->create()->getData();

        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }
        return $postCollections;
    }

    public function getPostById($entityId)
    {   
        try {
            $postData = [];
            $postCollections = $this->postCollectionFactory->create()
            ->addFieldToFilter('entity_id', ['eq'=> $entityId])
            ->getData();
            foreach ($postCollections as $post) {
                $postData = [
                    'entity_id' => $post['entity_id'],
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'categories' => $post['categories'],
                    'created_at' => $post['created_at'],
                    'updated_at' => $post['updated_at']
                ];
            }
        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }
        return $postData;
    }

    public function createPost($postTitle,$postDescription,$postCategories,$postCreatedAt,$postUpdatedAt)
    {
        $message = [];
        try {
            $postFactory = $this->postApiFactory->create();
            $postdata = [
                "title" => $postTitle,
                "description" => $postDescription,
                "categories" => $postCategories,
                "created_at" => $postCreatedAt,
                "updated_at" => $postUpdatedAt
            ];         
            $postFactory->setData($postdata);
            $postFactory->save();
            $msg = "Post data saved successfully ".$postTitle." ".$postDescription." ".$postCategories." ".$postCreatedAt." ".$postUpdatedAt;            
        	$message['message'] = $msg;

        } catch (\Exception $e) {
        	$message['message'] = "Error".$e;
        }        
        return $message;
    }


    public function updatePost($entity_id,$postTitle,$postDescription,$postCategories,$postCreatedAt,$postUpdatedAt)
    {
        try {
            $postFactory = $this->postApiFactory->create();
            $postData = [
                "entity_id" => $entity_id,
                "title" => $postTitle,
                "description" => $postDescription,
                "categories" => $postCategories,
                "created_at" => $postCreatedAt,
                "updated_at" => $postUpdatedAt
            ];
            $postFactory->setData($postData);
            $postFactory->save();
            $msg = "Post updated Successfully entity_id is ".$entity_id;
            $message['message'] = $msg;

        } catch (\Exception $e) {
            $message['message'] = "Error".$e;
        }        
        return $message;
    }

    public function deletePost($entityId)
    {
        try {
            $postFactory = $this->postApiFactory->create();
            $postFactory->load($entityId);
            $postFactory->delete();
            $msg = "Delete post successfully entity id is ".$entityId;
            $message['message'] = $msg;

        } catch (\Exception $e) {
            $message['message'] = "Error".$e;
        }        
        return $message;
    }
    
}