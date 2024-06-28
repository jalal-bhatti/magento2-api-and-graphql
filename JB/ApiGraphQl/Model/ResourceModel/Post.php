<?php
namespace JB\ApiGraphQl\Model\ResourceModel;
 
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init("jb_posts", "entity_id");
    }
}