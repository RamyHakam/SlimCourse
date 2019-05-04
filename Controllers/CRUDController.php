<?php
/**
 * Created by PhpStorm.
 * User: ramy
 * Date: 5/3/19
 * Time: 2:47 PM
 */

namespace Controllers;


use Parse\ParseObject;
use Parse\ParseQuery;
use Psr\Container\ContainerInterface;
use Slim\Exception\NotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class CRUDController
{


    private  $container;

    public function __construct( ContainerInterface $container)
    {
        $this->container=$container;
    }


    /**
     * Add new post to the database
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Exception
     */
    public  function  AddPost(Request $request ,Response $response){

        $data=$request->getParsedBody();
        $newPost= new ParseObject('SlimPosts');
        $newPost->set('title',$data['title']);
        $newPost->set('body',$data['body']);
        $newPost->set('likes',$data['likes']);
        $newPost->set('user',$this->getUserObject($data['userId'],$this));
        $newPost->save();
        return $response->withJson(['status'=>true,'postId'=>$newPost->getObjectId()]);


    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws \Exception
     */
    public  function  getPost(Request $request ,Response $response,array $args){

        try {
            $query = new ParseQuery('SlimPosts');
            $query->includeKey('user');
            if (isset($args['postId'])) {
                $query->equalTo('objectId', $args['postId']);
            }
            $posts = $query->find();
            $postsList = [];
            foreach ($posts as $post) {
                $data = ['postId' => $post->getObjectId(), 'title' => $post->get('title'), 'body' => $post->get('body'), 'likes' => $post->get('likes'), 'userName' => $post->get('user')->get('name'), 'createdAt' => $post->getCreatedAt()->getTimeStamp()];
                array_push($postsList, $data);
            }
            return $response->withJson(['status' => true, 'posts' => $postsList], 200);
        }catch ( Exception $ex){
            return $response;
        }


    }


    /**
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Parse\ParseException
     */
    public  function  updatePost(Request $request, Response $response){

        $data=$request->getParsedBody();
        $query=new ParseQuery('SlimPosts');
        $post=$query->get($data['postId']);
        $post->set('title',$data['title']);
        $post->set('body',$data['body']);
        $post->save();
        return $response->withJson(['status'=>true,'message'=>'post  is updated']);

    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public  function  deletePost(Request $request, Response $response , array $args){
        $data=$request->getParsedBody();
        $query=new  ParseQuery('SlimPosts');
        if (isset($args['postId'])) {
            $query->equalTo('objectId', $args['postId']);
        }
        $posts=$query->find();

        foreach ($posts as $post){$post->destroy();}
        return $response->withJson(['status'=>true,'message'=>'post  is deleted']);

    }

    /**
     * @param $userId
     * @param $service
     * @return array|ParseObject
     * @throws \Parse\ParseException
     */
    private  function getUserObject($userId,$service) {

        $query=new ParseQuery('SlimUsers');
        $user= $query->get($userId);
        return $user;

    }

}