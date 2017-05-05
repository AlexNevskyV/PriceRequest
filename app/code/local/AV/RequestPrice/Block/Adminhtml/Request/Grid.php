<?php

class AV_RequestPrice_Block_Adminhtml_Request_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId("requestGrid");
        $this->setDefaultSort("created_at");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel("avrequestprice/request")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        /*
        $this->addColumn("id", array(
            "header" => $this->__("Id"),
            "align"  => "right",
            "width"  => "30px",
            "type"   => "number",
            "index"  => "id",
        ));
        */
        $this->addColumn("customer_name", array(
            "header" => $this->__("Name"),
            "align"  => "right",
            "width"  => "200px",
            "type"   => "varchar",
            "index"  => "customer_name",
        ));

        $this->addColumn("customer_email", array(
            "header" => $this->__("Email"),
            "align"  => "right",
            "width"  => "200px",
            "type"   => "varchar",
            "index"  => "customer_email",
        ));


        $this->addColumn("created_at", array(
            "header" => $this->__("Created At"),
            "align"  => "right",
            "width"  => "50px",
            "type"   => "datetime",
            "index"  => "created_at",
        ));

        $this->addColumn('status', array(
            'header'  => $this->__('Status'),
            'align'   => 'right',
            'width'   => '50px',
            'index'   => 'status',
            'type'    => 'options',
            'options' => array(
                0 => 'New',
                1 => 'In Progress',
                2 => 'Close',
            ),
        ));

        $this->addColumn('view', array(
            'header'   => $this->__('Action'),
            'width'    => '50px',
            'type'     => 'action',
            'getter'   => 'getId',
            'actions'  => array(
                array(
                    'caption' => $this->__('View'),
                    'url'     => array(
                        'base'   => 'adminhtml/request/edit',
                        'params' => array('store' => $this->getRequest()->getParam('store'))
                    ),
                    'field'   => 'id'
                )
            ),
            'filter'   => false,
            'sortable' => false,
            'index'    => 'stores',
        ));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

}
