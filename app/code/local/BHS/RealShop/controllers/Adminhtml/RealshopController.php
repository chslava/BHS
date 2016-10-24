<?php

class BHS_RealShop_Adminhtml_RealshopController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()->_setActiveMenu('bhs_realshop/shop');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id', null);
        $model = Mage::getModel('bhs_realshop/realshop');
        if ($id) {
            $model->load((int)$id);
            if ($model->getId()) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if ($data) {
                    $model->setData($data)->setId($id);
                }
            } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bhs_realshop')->__('Shop does not exist'));
                $this->_redirect('*/*/');
            }
        }
        Mage::register('shop_data', $model);

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost())
        {
            if (isset( $_FILES['image']['name']) && file_exists($_FILES['image']['tmp_name']) )
            {
                if ($this->_uploadImage('image')) {
                    $data['image'] =  $_FILES['image']['name'] ;
                } else {
                    unset($data['image']);
                }
            }
            else
            {
                if (isset($data['image']['delete']) && $data['image']['delete'] == 1)
                {
                    if ($data['image']['value'] != '')
                        $this->_removeFile($data['image']['value']);
                    $data['image'] = '';
                }
                else
                {
                    unset($data['image']);
                }
            }

            $model = Mage::getModel('bhs_realshop/realshop');
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
            $model->setData($data);

            Mage::getSingleton('adminhtml/session')->setFormData($data);
            try {
                if ($id) {
                    $model->setId($id);
                }
                $model->save();

                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('bhs_realshop')->__('Error saving shop'));
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('bhs_realshop')->__('Shop data was successfully saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                if ($model && $model->getId()) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                } else {
                    $this->_redirect('*/*/');
                }
            }

            return;
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bhs_realshop')->__('No data to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('bhs_realshop/realshop');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('awesome')->__('The example has been deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Unable to find the Shop to delete.'));
        $this->_redirect('*/*/');
    }

    protected function _removeFile($file)
    {
        $result = false;
        $io = new Varien_Io_File();
        $file = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . $file;
        if (file_exists($file)){
            $result = $io->rm($file);
        }
        return $result;
    }

    protected function _uploadImage($name) {
        $result = false;
        try {
            $uploader = new Varien_File_Uploader($name);
            $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
            $uploader->setAllowRenameFiles(false);
            $uploader->setFilesDispersion(false);

            $path = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS ;

            $result = $uploader->save($path, $_FILES[$name]['name']);

        }catch(Exception $e) {
            Mage::getSingleton('core/session')->addError('Unable to save image. ' . $e->getMessage());
        }

        return $result;
    }
}