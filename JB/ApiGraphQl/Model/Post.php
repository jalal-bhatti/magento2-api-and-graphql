<?php
namespace JB\ApiGraphQl\Model;
use Magento\Framework\Model\AbstractModel;
 
class Post extends AbstractModel
{
    public function _construct()
    {
        $this->_init(\JB\ApiGraphQl\Model\ResourceModel\Post::class);
    }
}