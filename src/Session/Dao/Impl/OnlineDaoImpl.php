<?php

namespace Codeages\Biz\Framework\Session\Dao\Impl;

use Codeages\Biz\Framework\Dao\GeneralDaoImpl;
use Codeages\Biz\Framework\Session\Dao\OnlineDao;

class OnlineDaoImpl extends GeneralDaoImpl implements OnlineDao
{
    protected $table = 'biz_online';

    public function getBySessId($sessionId)
    {
        return $this->getByFields(array('sess_id' => $sessionId));
    }

    public function deleteByInvalid()
    {
        $sql = "DELETE FROM {$this->table} WHERE sess_deadline < ?";
        return $this->db()->executeUpdate($sql, array(time()));
    }

    public function declares()
    {
        return array(
            'timestamps' => array('created_time', 'sess_time'),
            'orderbys' => array('sess_time'),
            'serializes' => array(
            ),
            'conditions' => array(
                'sess_time > :gt_sess_time',
                'is_login = :is_login',
                'user_id = :user_id'
            ),
        );
    }
}