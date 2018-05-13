<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Members cell
 */
class MembersCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
      $this->loadModel('Members');
      $member = $this->Members->newEntity();
      if($this->request->is('post')) {
        $member = $this->Members->patchEntity($member, $this->request->getData());
      }
      $form_data = $this->getFormOptions();
      $this->set(compact('member', 'form_data'));
    }

    private function getFormOptions()
    {
      $form_data = array();
      $form_data['base'] = [
        'type'  => 'post'
      , 'url'   => [ 'controller' => 'Members', 'action' => 'add' ]
      , 'template' => $this->getFormTemplates()
      ];
      $form_data['hidden_id'] = [
        'type'  => 'hidden'
      , 'value' => 12345
      ];
      $form_data['name'] = [
        'label' => '一般的なテキスト'
      ];
      $form_data['email'] = [
        'type'  => 'email'
      , 'label' => 'メールアドレス'
      ];
      $form_data['password'] = [
        'label' => 'パスワード'
      ];
      $form_data['age'] = [
        'type'      => 'number'
      , 'label'     => '数値のみ'
      , 'required'  => true
      , 'min'       => 20
      , 'max'       => 100
      ];
      $form_data['gender'] = [
        'type'      => 'radio'
      , 'label'     => 'ラジオボタン'
      , 'required'  => true
      , 'options'   => $this->getOptionsGender()
      ];
      $form_data['birthplace'] = [
        'type'      => 'select'
      , 'label'     => 'セレクトボックス'
      , 'required'  => true
      , 'options'   => $this->getOptionsBirthplace()
      , 'multiple'  => false
      , 'empty'     => '選択してください'
      ];
      $form_data['birth_at'] = [
        'type'        => 'datetime'
      , 'label'       => '日時'
      , 'required'    => true
      , 'monthNames'  => false
      , 'minYear'     => date('Y')
      , 'maxYear'     => date('Y') + 1
      ];
      $form_data['checkbox_1'] = [
        'type'  => 'checkbox'
      , 'label' => '通知を受け取らない'
      ];
      $form_data['checkbox_2'] = [
        'type'  => 'checkbox'
      , 'label' => '申し込む'
      ];
      return $form_data;
    }

    private function getOptionsGender()
    {
      return [
        1 => '女性'
      , 2 => '男性'
      , 3 => 'その他'
      ];
    }

    private function getOptionsBirthplace() 
    {
      return [
        ['text' => '北海道', 'value' => 1]
      , ['text' => '東京都', 'value' => 2]
      , ['text' => '大阪府', 'value' => 3]
      , ['text' => '福岡県', 'value' => 4]
      , ['text' => '沖縄県', 'value' => 5]
      ];
    }

    private function getFormTemplates()
    {
      return [
        'formstart' => '<form{{attrs}}>',
        'formend' => '</form>',
        'formGroup' => '{{label}}{{input}}',
        'groupContainer' => '<div class="input {{type}}{{required}}">{{content}}</div>',
        'groupContainerError'
          => '<div class="input {{type}}{{required}} error">{{content}}{{error}}</div>',
        'legend' => '<legend>{{text}}</legend>',
        'fieldset' => '<fieldset>{{content}}</fieldset>',
        'error' => '<div class="error-message">{{content}}</div>',
        'errorList' => '<ul>{{content}}</ul>',
        'errorItem' => '<li>{{text}}</li>',
        'label' => '<label{{attrs}}>{{text}}</label>',
        'hiddenblock' => '<div style="display:none;">{{content}}</div>',
        'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}>',
        'inputsubmit' => '<input type="{{type}}"{{attrs}}>',
        'file' => '<input type="file" name="{{name}}"{{attrs}}>',
        'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>',
        'selectMultiple'
          => '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
        'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
        'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
        'radio' => '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
        'radioWrapper' => '{{label}}',
        'checkboxWrapper' => '<div class="checkbox">{{input}}{{label}}</div>',
        'checkboxFormGroup' => '{{input}}{{label}}',
        'checkbox' => '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
        'dateWidget' => '{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}',
        'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
        'button' => '<button{{attrs}}>{{text}}</button>',
        'submitContainer' => '<div class="submit">{{content}}</div>',
      ];
    }
}
