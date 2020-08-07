<?php


namespace MagePrakash\Helpdesk\Model\ResourceModel;

class Ticket extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mageprakash_helpdesk_ticket', 'ticket_id');
    }

    /**
     *
     * @param  int $id
     * @return string
     */
    private function getGeneratedNumber($id)
    {
        $prefix = '';
        for ($i = 0; $i < 3; $i++) {
            $prefix .= chr(rand(ord('a'), ord('z')));
        }
        $id = (string) $id;
        for ($i = 0; strlen($id) - 5; $i++) {
            $id = '0' . $id;
        }
        return strtoupper($prefix) . '-' . $id;
    }

    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        parent::_afterSave($object);

        $connection = $this->getConnection();
        if ($object->isObjectNew() && $this->hasEmptyData($object, 'number')) {
            $number = $this->getGeneratedNumber($object->getTicketId());
            $data = ['number' => $number];
            $where = ['ticket_id = ?' => (int) $object->getTicketId()];
            $connection->update($this->getTable('mageprakash_helpdesk_ticket'), $data, $where);
            $object->setData('number', $number);
        }
    }

        /**
     *
     * @param  \Magento\Framework\Model\AbstractModel $object
     * @param  string                                 $key
     * @return boolean
     */
    private function hasEmptyData(\Magento\Framework\Model\AbstractModel $object, $key)
    {
        if ($object->hasData($key)) {
            $data = $object->getData($key);
            return empty($data);
        }

        return true;
    }
}
