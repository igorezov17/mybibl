<?php 

class AddBookForm extends CFormModel
{
    public $label;
    public $author;
 
    public function rules()
    {
        return array(
            array('label, author', 'required')
        );
    }
}