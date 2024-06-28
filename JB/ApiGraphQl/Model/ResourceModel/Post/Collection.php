<?php
namespace JB\ApiGraphQl\Model\ResourceModel\Post;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init(
            \JB\ApiGraphQl\Model\Post::class,
            \JB\ApiGraphQl\Model\ResourceModel\Post::class
        );
    }
}