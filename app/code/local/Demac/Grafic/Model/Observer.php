<?php

class Demac_Grafic_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     * @return Demac_Grafic_Model_Observer
     *
     * for infinite scroll we need to change the page size and offset for any page but the first one
     */
    public function adjustCollection(Varien_Event_Observer $observer)
    {
        $productCollection = $observer->getEvent()->getCollection();

        if ($productCollection instanceof Varien_Data_Collection) {
            $productCollection->addOrder('entity_id', 'ASC'); // mySQL was returning records in an inconsistent order without this
            // do this only not on first page load
            $currentPage = (int) Mage::App()->getRequest()->getParam('p');
            if (1 < $currentPage){
                $productCollection->setCurPage(1)->setPageSize(2);

                $dontUse = array();
                foreach($productCollection as $item){
                    $dontUse[] = $item->getId();
                }
                $productCollection->clear();
                $productCollection->addAttributeToFilter('entity_id', array('nin' => $dontUse));
                $productCollection->setCurPage($currentPage)->setPageSize(8);
            }
        }

        return $this;
    }
}