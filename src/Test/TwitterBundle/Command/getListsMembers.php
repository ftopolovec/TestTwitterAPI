<?php

namespace Test\TwitterBundle\Command;

use Guzzle\Service\Command\AbstractCommand;

class getListsMembers extends AbstractCommand
{
    protected function build()
    {
        $this->request = $this->client->get('lists/members.json');
        $query = $this->request->getQuery();

        if ($this['list_id']) {
            $query->set('list_id', $this['list_id']);
        }

        if ($this['slug']) {
            $query->set('slug', $this['slug']);
        }

        if ($this['screen_owner_name']) {
            $query->set('screen_owner_name', $this['screen_owner_name']);
        }
    }
}
