<div class="ui-widget">
    [[+input_type:isequalto=`textarea`:then=`
    <textarea rows="5" cols="55" name="[[+name]]" id="[[+input_id]]" class="ui-widget ui-widget-content ui-corner-all" title="[[+title]]">[[+value]]</textarea>
    `:else=`
    <input type="[[+input_type]]" name="[[+name]]" id="[[+input_id]]" class="ui-widget ui-widget-content ui-corner-all" title="[[+title]]" value="[[+value]]" />
    `]]
</div>
