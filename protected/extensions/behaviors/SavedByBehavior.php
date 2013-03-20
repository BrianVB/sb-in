<?php

/**
 * Sets the ID of the current user in the created by or updated by fields
 * So we can know who made these thigns
 *	Usage:
 *   public function behaviors() {
 *       return array(            
 *           'SavedByBehavior' => array(
 *               'class' => 'ext.behaviors.SavedByBehavior',
 *           ),
 *       );
 *   }
 */
class SavedByBehavior extends CActiveRecordBehavior {
    public function beforeSave($event) {
        parent::beforeSave($event);
        $owner = $this->getOwner();
        if($owner->isNewRecord){
            $owner->created_by = Yii::app()->user->id;
        } else {
            $owner->updated_by = Yii::app()->user->id;
        }
    }
}