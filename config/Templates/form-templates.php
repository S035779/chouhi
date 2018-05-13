<?php

return [
  /**
   * 通常のフォームテンプレート
   */
  'formStart'           => '<form class="form-horizontal" {{attrs}}>'
, 'hiddenBlock'         => '<div style="display:none;">{{content}}</div>'
, 'inputContainerError' => '<div class="form-group has-error"><label class="col-sm-2 control-label" {{attrs}}>{{label}}</label><div class="col-sm-10">{{content}}{{error}}</div></div><div class="hr-line-dashed"></div>'
, 'inputContainer'      => '<div class="form-group"><label class="col-sm-2 control-label" {{attrs}}>{{label}}</label><div class="col-sm-10">{{content}}</div></div><div class="hr-line-dashed"></div>',
  'label'               => '<label class="col-sm-2 control-label" {{attrs}}>{{text}}</label>'
, 'input'               => '<input class="form-control" type="{{type}}" name="{{name}}" {{attrs}}>'
, 'textarea'            => '<textarea name="{{name}}" class="form-control" {{attrs}}>{{value}}</textarea>'
, 'select'              => '<select name="{{name}}" class="chosen-select"  tabindex="2">{{content}}</select>'
, 'option'              => '<option value="{{value}}"{{attrs}}>{{text}}</option>'
, 'button'              => '<div class="form-group"><div class="col-sm-4 col-sm-offset-2"><button type="{{type}}" class="btn btn-primary" {{attrs}}>{{text}}</button></div></div>'
  /**
   * Widgetクラス DatePickerWidget 独自テンプレート
   */
, 'datepicker'          => '<div class="input-group date"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="{{value}}" class="form-control" name="{{name}}" data-date-format="yyyy-mm-dd" {{attrs}}></div>'
];
