<?php 

class AddStoreForm extends CFormModel
{
    public $library;
    public $count;
 
    public function rules()
    {
        return array(
            array('library, count', 'required'),
            array('library, count', 'numerical')
        );
    }
}