<?php
 
namespace JB\ApiGraphQl\Model\Api;

class PostRestApi implements \JB\ApiGraphQl\Api\PostApiInterface
{
    protected $collectionFactory;
    /**
     * Model Initialization
     *
     * @return void
     */
    public function __construct(
        \JB\ApiGraphQl\Model\PostFactory $postFactory,
        \JB\ApiGraphQl\Model\ResourceModel\Post\CollectionFactory $collectionFactory
    )
    {
        $this->postFactory = $postFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @api
     * @param string[] $postdata
     * @return mixed
     */
    public function postAddAndEdit($postdata)
    {
        try {
            $postModel = $this->postFactory->create();
            if(isset($postdata['entity_id'])){
                $postModel->load($postdata['entity_id']);
            }
            $postModel->setData($postdata);
            $postModel->save();
            $response = ['success' => true, 'message' => "Post successFully saved"];
        } catch(\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    /**
     * @api
     * @param int $entityId
     * @return string
     */
    public function deletePost($entityId)
    {   
        try {
            $postData = $this->postFactory->create()
            ->load($entityId)
            ->delete();
            $msg = "Post delete successfully";
            $response = ['message'=>$msg];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }  

     /**
     * @api
     * @return array|mixed
     */
    public function getPosts()
    {
        try {
            $postdata = $this->collectionFactory->create()->getData();
            $response = ["postdata" => $postdata];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    /**
     * @api 
     * @param int $entityId
     * @return string
     */
    public function getPost($entityId){
        try {
            $postData = $this->collectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('entity_id', ['eq' => $entityId])
            ->getData();
            $response = ['postData'=>$postData];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }
}
