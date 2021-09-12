<div id="{$ID}" class="popover callbox custom-popover" style="display:block;width: 450px;padding:0">
    <input type="hidden" id="list_bean_json" value='{$LIST_BEAN_JSON}'/>
    <input type="hidden" id="callbox_bean_id" value="{$BEAN_ID}"/>
    <input type="hidden" id="callbox_bean_type" value="{$BEAN_NAME}"/>
    <input type="hidden" id="callbox_full_name" value="{$FULL_NAME}"/>
    <input type="hidden" id="Direction"/>
    <input type="hidden" id="Duration"/>
    <input type="hidden" id="StartTime"/>
    <input type="hidden" id="EndTime"/>
    <input type="hidden" id="Extension"/>
    <div class="popover-title" style="background-color: #203b6c;color:#fff;padding:0px">
        <div style="background-color: #132545;height: 20px;padding: 10px 15px 5px 15px;">
            <div class="btn-group pull-left" style="color:#fff">
                <i class="far fa-edit dropdown-toggle" rel="tooltip" title="Change/Create" data-toggle="dropdown" style="cursor: pointer;font-size:16px;"></i>
                <ul class="dropdown-menu">
                    {$LIST_BEAN_SELECT}
                    <li class="divider"></li>
                    <li><a onclick="CALL_CENTER.changeBean('Leads','{$ID}')">Select From Lead</a></li>
                    <li><a onclick="CALL_CENTER.changeBean('Contacts','{$ID}')">Select From Contact</a></li>
                    <li><a onclick="CALL_CENTER.changeBean('Accounts','{$ID}')">Select From Account</a></li>
                </ul>
            </div>

            <span class="pull-left bean_type_display" style="margin-left:5px;font-size: 13px">{$BEAN_NAME}</span>
            <i onclick="CALL_CENTER.closeCallBox('{$ID}')" class="far fa-times pull-right mini-call-box" rel="tooltip" title="close" style="color: red !important;cursor: pointer;font-size:16px;margin-left:15px;"></i>
            <i onclick="CALL_CENTER.miniCallBox('{$ID}')" class="far fa-chevron-down pull-right mini-call-box" rel="tooltip" title="mini" style="cursor: pointer;font-size:16px"></i>

            <div class="btn-group pull-left transfer-btn-group" style="display: none">
                <a class="btn btn-primary dropdown-toggle" rel="tooltip" title="Transfer Call" data-toggle="dropdown">
                    <i class="fa fa-exchange"></i>
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a onclick="CALL_CENTER.transferCall('{$ID}','100')"></a></li>
                </ul>
            </div>
        </div>

        <table width="100%" style="background-color: #203b6c;margin-top:3px">
            <tr>
                <td width="15%" style="vertical-align: middle;text-align: center;padding:5px">
                    <i style="font-size: 50px;color: #fff" class="far fa-phone-alt"></i>
                </td>
                <td width="65%">
                    <a class="link_to_bean" href="#{$BEAN_NAME}/{$BEAN_ID}" style="font-size: 16px;color:#fff"><b>{$FULL_NAME}</b></a><br/>
                    <span class="bean_status">Status: {$BEAN_STATUS}<br/></span>
                    <span class="bean_phone">Phone: {$ID}<br/></span>
                    <span class="bean_address">Address: {$STATE}, {$CITY}</span>
                </td>
                <td nowrap width="20%" style="vertical-align: middle;text-align: center;padding:5px">
                    <b>{$TYPE_CALL}</b><br/>
                    <label class="label label-call-status label-inverse">Waiting</label><br/>
                    <span class="duration-call">_ _:_ _</span>
                </td>
            </tr>
        </table>
    </div>
    <div class="popover-content">
        <div class="row-fluid">
            <div class="span3" style="padding-top:5px">Call Purpose:</div>
            <div class="span9">
                <select class="slc_call_purpose form-control" style="width: 100%;margin-bottom: 5px;">
                    {foreach from=$CALLPURPOSE_OPTIONS key=KP item=OP}
                        <option value="{$KP}">{$OP}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3" style="padding-top:5px">Call Result:<span style="color:red;font-weight: bold">(*)</span></div>
            <div class="span9">
                <select onchange="CALL_CENTER.changeCallResult('{$ID}')" class="slc_call_result form-control" style="width: 100%;margin-bottom: 5px;">
                    {foreach from=$CALLRESULT_OPTIONS key=KP item=OP}
                        <option value="{$KP}">{$OP}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3"></div>
            <div class="span9" style="margin-bottom: 5px;">
                <div class="row-fluid">
                    <div class="span6">
                        <label><input class="favorite" type="checkbox" style="float: left;margin-right:5px">Mark favorite</label>
                    </div>
                    <div class="span6">
                        <label><input class="deadlead" type="checkbox" style="float: left;margin-right: 5px">Mark dead lead</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid recall">
            <div class="span3" style="padding-top:5px;white-space: nowrap;">Request callback:</div>
            <div class="span9" style="margin-bottom: 5px;">
                <select class="slc-recall form-control" style="width: 100%;margin-bottom: 5px;">
                    {foreach from=$RECALL_OPTIONS item=OP key=KP}
                        <option value="{$KP}">{$OP}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        <div class="row-fluid timerecall" style="display: none">
            <div class="span3" style="padding-top:5px;white-space: nowrap;">Time callback:</div>
            <div class="span9" style="margin-bottom: 5px;">
                <div class="input-append">
                    <div class="date-wrapper">
                        <input class="recall_at" type="text" style="width:95%">
                        <span class="add-on"><i class="far fa-calendar"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-fluid control-group">
            <div class="controls span12">
                <textarea data-saved="0" class="call-description" rows="3" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="row-fluid feedback-footer">
                <span class="span12">
                        <button data-type="save_call_log" data-click="0" onclick="$(this).attr('data-click','1');CALL_CENTER.saveCallLog('{$ID}')" class="btn-save btn btn-primary pull-right span12">Save</button>
                </span>
        </div>
    </div>
</div>