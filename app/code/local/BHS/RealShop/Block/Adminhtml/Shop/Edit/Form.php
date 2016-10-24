<?php

class BHS_RealShop_Block_Adminhtml_Shop_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        if (Mage::getSingleton('adminhtml/session')->getShopData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getShopData();
        }
        elseif (Mage::registry('shop_data'))
        {
            $data = Mage::registry('shop_data')->getData();
        }
        else
        {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));

        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset('shop_form', array(
            'legend' =>Mage::helper('bhs_realshop')->__('Shop Information')
        ));

        $fieldset->addField('shop_name', 'text', array(
            'label'     => Mage::helper('bhs_realshop')->__('Shop Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'shop_name'
        ));

        $fieldset->addField('address', 'text', array(
            'label'     => Mage::helper('bhs_realshop')->__('Shop Address'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'address'
        ));

        $fieldset->addField('short_description', 'text', array(
            'label'     => Mage::helper('bhs_realshop')->__('Short Description'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'short_description',
        ));

        $fieldset->addField('long_description', 'textarea', array(
            'label'     => Mage::helper('bhs_realshop')->__('Long Description'),
            'required'  => false,
            'name'      => 'long_description',
        ));

        $fieldset->addField('image', 'image', array(
            'label'     => Mage::helper('bhs_realshop')->__('Shop Picture'),
            'required'  => false,
            'name'      => 'image',
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }
}