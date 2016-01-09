<?php

namespace Test\TwitterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Test\TwitterBundle\Entity\Tweets;
use Test\TwitterBundle\Entity\TwitterUser;

class DefaultController extends Controller
{
    public function newAction($username)
    {
        $twitterClient = $this->container->get('guzzle.twitter.client');
        $newuser = $twitterClient->post('lists/members/create.json?list_id=231207061&slug=Actualized.org&screen_name='.$username)
        ->send()->getBody();

        $getuser = $twitterClient->get('users/show.json?screen_name='.$username)->send()->getBody();
        $user = json_decode($getuser, true);
        $id = $user['id'];
        $username = $user['screen_name'];

        $twitterUser = new TwitterUser();
        $twitterUser->setIdTwitter($id);
        $twitterUser->setUsername($username);

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('TestTwitterBundle:TwitterUser')->findByid_twitter($id);
        if (!$repo) {
            $em->persist($twitterUser);
            $em->flush();
        } else {
            return new Response('User already exists!');
        }

        return $this->redirect('/');
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('TestTwitterBundle:TwitterUser')->findAll();

        return $this->render('TestTwitterBundle:Default:index.html.twig', array(
            'users' => $users,
        ));
    }

    public function singleAction($username, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $singleuser = $em->getRepository('TestTwitterBundle:TwitterUser')->findByUsername($username);

        $twitterClient = $this->container->get('guzzle.twitter.client');
        $usertweets = $twitterClient->get('statuses/user_timeline.json?count=20&screen_name='.$username)
            ->send()->getBody();

        $usertweets = json_decode($usertweets, true);
        $count = (count($usertweets)) - 1;
        for ($x = 0; $x <= $count; ++$x) {
            $tweettext = $usertweets[$x]['text'];
            $tweetid = $usertweets[$x]['id'];

            $id = $em->getRepository('TestTwitterBundle:TwitterUser')->find($id);
            $checkrepo = $em->getRepository('TestTwitterBundle:Tweets')->findByIdTwitter($tweetid);

            $twitterTweet = new Tweets();
            $twitterTweet->setIdTwitter($tweetid);
            $twitterTweet->setText($tweettext);
            $twitterTweet->setUser($id);
            if (!$checkrepo) {
                $em->persist($twitterTweet);
                $em->flush();
            }
        }

        return $this->render('TestTwitterBundle:Default:single.html.twig', array(
            'singleuser' => $singleuser,
            'tweets' => $usertweets,
        ));
    }

    public function searchAction()
    {
        $data = array();
        $form = $this->createFormBuilder($data, array(
            'action' => $this->generateUrl('search'),
        ))
            ->add('query', 'text')
            ->add('username', 'choice',
                array('choices' => array(
                    'Username1' => 'Username1',
                    'Username2' => 'Username2',
                    'Username3' => 'Username3',
                )))
            ->add('submit', 'submit', array('label' => 'Search'))
            ->getForm();

        return $this->render('TestTwitterBundle:Default:search.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
