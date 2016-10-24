<?php

class BHS_RealShop_Block_Adminhtml_Shop_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'shop_id';
        $this->_blockGroup = 'bhs_realshop';
        $this->_controller = 'adminhtml_shop';
        $this->_mode = 'edit';

        $this->_addButton('save_and_continue', array(
            'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);
        $this->_updateButton('save', 'label', Mage::helper('bhs_realshop')->__('Save Shop'));

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('shop_data') && Mage::registry('shop_data')->getId())
        {
            return Mage::helper('bhs_realshop')->__('Edit Shop "%s"', self::escapeHtml(Mage::registry('shop_data')->getShopName()));
        } else {
            return Mage::helper('bhs_realshop')->__('New Shop');
        }
    }

}