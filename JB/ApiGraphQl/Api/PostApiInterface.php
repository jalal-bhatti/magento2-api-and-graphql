<?php

namespace JB\ApiGraphQl\Api;

interface PostApiInterface {
    /**
     * @api
     * @param string[] $postdata
     * @return mixed
     */
    public function postAddAndEdit($postdata);
    /**
     * @api
     * @param int $entityId
     * @return string
     */
    public function deletePost($entityId);

     /**
     * @api
     * @return array|mixed
     */
    public function getPosts();
    
     /**
     * @api
     * @param int $entityId
     * @return string
     */
    public function getPost($entityId);


}