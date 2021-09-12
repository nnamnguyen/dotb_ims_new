<link rel='stylesheet' href='{$custom_sms_css_path}' type='text/css'>
<script type="text/javascript" src="{dotb_getjspath file='cache/include/javascript/dotb_grp_yui_widgets.js'}"></script>
<form name="SurveySmsSettings" id="" method="POST">

    <h2>SMS/WhatsApp Setting</h2>
    <br/>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="edit view sms_template">
        <tbody>

            <tr>
                <th align="left" scope="row" colspan="7">
                    <h4>Configuring SMS/WhatsApp Setting</h4>
                </th>
            </tr>
            <tr>
                <td scope="row" class="form-heading-label">Twilio id: <span class="required">*</span></td>
                <td class="form-field" style="width:270px;" > <input id="survey_sms_sid" name="survey_sms_sid" tabindex="1" size="25" maxlength="128" type="text" value="{$survey_sms_sid}"></td>

                <td scope="row" class="form-heading-label">Twilio Token: <span class="required">*</span></td>
                <td class="form-field" style="width:270px;"><input id="survey_sms_smsToken" name="survey_sms_smsToken" tabindex="1" size="25" maxlength="128" type="text" value="{$survey_sms_token}"></td>
                <td class="form-field" >Default <img style="height:12px;" id="default_helptip" src='custom/include/survey-img/question.png' title='Default number selected will always be used to send sms.'></td>
                <td class="form-field" ></td>
                <td class="form-field" ></td>
            </tr>
            <tr>
                {if $isSmsSet eq 1}
                    <td scope="row" class="form-heading-label"><input type="checkbox" value="sms" onclick="ShowHideDetails(this, 'sms')" id="smsDetails" checked/>SMS</div></td>
                    {else}
                    <td scope="row" class="form-heading-label"><input type="checkbox" value="sms" onclick="ShowHideDetails(this, 'sms')" id="smsDetails"/>SMS</div></td>
                    {/if}
                    {if $isWhatsppSet eq 1}
                    <td scope="row" class="form-field" class="form-heading-label"><input type="checkbox" value="whatsapp" onclick="ShowHideDetails(this, 'whatsapp')" id="whatsappDetails" checked/>WhatsApp</div></td>
                    {else}
                    <td scope="row" class="form-field" class="form-heading-label"><input type="checkbox" value="whatsapp" onclick="ShowHideDetails(this, 'whatsapp')" id="whatsappDetails"/>WhatsApp</div></td>
                    {/if}
                <td class="form-field" ></td>
                <td class="form-field" ></td>
                <td class="form-field" ></td>
                <td class="form-field" ></td>
                <td class="form-field" ></td>
            </tr>
            {if $isSmsSet eq 1}
                <tr class="sms_heading">
                {else}
                <tr class="sms_heading" style="display:none;">
                {/if}
                <td align="left" scope="row" colspan="7">
                    <b>Please enter details for SMS : </b>
                </td>
            </tr>

            {if $survey_sms_fromdetails neq ''}
                {foreach from=$survey_sms_fromdetails key=key item=fromDetails}
                    {if $isSmsSet eq 1}
                        <tr class="survey_from_sms_details_tr" id="survey_from_sms_details_tr_{$key}">
                        {else}
                        <tr class="survey_from_sms_details_tr" id="survey_from_sms_details_tr_{$key}" style="display:none;">
                        {/if}
                        {if $key eq 1}
                            <td scope="row" class="form-heading-label">From SMS Name: <span class="required">*</span></td>
                        {else}
                            <td scope="row" class="form-heading-label"></td>
                        {/if}
                        <td class="form-field"><input id="survey_sms_fromName_{$key}" placeholder="Enter Sender Information" name="survey_sms_fromName_{$key}" tabindex="1" size="25" maxlength="128" type="text" value="{$fromDetails.smsFromName}"></td>
                            {if $key eq 1}
                            <td scope="row" class="form-heading-label">From SMS Phone Number: <span class="required">*</span></td>
                        {else}
                            <td scope="row" class="form-heading-label"></td>
                        {/if}
                        <td class="form-field"><input id="survey_sms_fromPhoneNumber_{$key}" name="survey_sms_fromPhoneNumber_{$key}" placeholder="Enter SMS Mobile Number" tabindex="1" size="25" maxlength="128" type="text" value="{$fromDetails.smsFromPhoneNumber}"></td>
                            {if $fromDetails.defaultNumber eq 'default'}
                            <td class="form-field"><input type="radio" name="survey_sms_default_value" value="survey_sms_default_value_{$key}" checked style='margin-top:9px;'/></td>
                            {else}
                            <td class="form-field"><input type="radio" name="survey_sms_default_value" value="survey_sms_default_value_{$key}" style='margin-top:9px;'/></td>
                            {/if}
                            {if $survey_sms_fromdetailsLength gt 1}
                                {if $survey_sms_fromdetailsLength eq $key}
                                <td class="form-field"><input class="survey_sms_addMultiNumber" id="survey_sms_addMultiNumber_{$key}" name="survey_sms_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;" type="button" value="+" onclick="addMultipleNumber();"></td>
                                <td class="form-field"><input id="survey_sms_removeMultiNumber_{$key}" name="survey_sms_removeMultiNumber_{$key}" class="survey_sms_removeMultiNumber" style="height:28px;width:28px;cursor: pointer;" type="button" value="-" onclick="removeMultipleNumber(this);"></td>
                                {else}
                                <td class="form-field"><input class="survey_sms_addMultiNumber" id="survey_sms_addMultiNumber_{$key}" name="survey_sms_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;display: none;" type="button" value="+" onclick="addMultipleNumber();"></td>
                                    {if $key eq 1}
                                    <td class="form-field"></td>
                                {else}
                                    <td class="form-field"><input id="survey_sms_removeMultiNumber_{$key}" name="survey_sms_removeMultiNumber_{$key}" class="survey_sms_removeMultiNumber" style="height:28px;width:28px;cursor: pointer;" type="button" value="-" onclick="removeMultipleNumber(this);"></td>
                                    {/if}
                                {/if}
                            {else}
                            <td class="form-field"><input class="survey_sms_addMultiNumber" id="survey_sms_addMultiNumber_{$key}" name="survey_sms_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;" type="button" value="+" onclick="addMultipleNumber();"></td>
                            <td class="form-field"></td>
                        {/if}
                    </tr>
                {/foreach}
            {else}
                {if $isSmsSet eq 1}
                    <tr class="survey_from_sms_details_tr" id="survey_from_sms_details_tr_1" >
                    {else}
                    <tr class="survey_from_sms_details_tr" id="survey_from_sms_details_tr_1" style="display:none;">
                    {/if}
                    <td scope="row" class="form-heading-label">From SMS Name: <span class="required">*</span></td>
                    <td class="form-field"><input id="survey_sms_fromName_1" placeholder="Enter Sender Information" name="survey_sms_fromName_1" tabindex="1" size="25" maxlength="128" type="text" value=""></td>
                    <td scope="row" class="form-heading-label">From SMS Phone Number: <span class="required">*</span></td>
                    <td class="form-field"><input id="survey_sms_fromPhoneNumber_1" name="survey_sms_fromPhoneNumber_1" placeholder="Enter SMS Mobile Number" tabindex="1" size="25" maxlength="128" type="text" value=""></td>
                    <td class="form-field"><input type="radio" name="survey_sms_default_value" value="survey_sms_default_value_1" style='margin-top:9px;'/></td>
                    <td class="form-field"><input class="survey_sms_addMultiNumber" id="survey_sms_addMultiNumber_1" name="survey_sms_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;" type="button" value="+" onclick="addMultipleNumber();"></td>
                    <td class="form-field"></td>
                </tr>
            {/if}
            {*For WhatsApp*}
            {if $isWhatsppSet eq 1}
                <tr id="whatsappTr" class="whatsapp_heading">
                {else}
                <tr id="whatsappTr" class="whatsapp_heading" style="display:none;">
                {/if}
                <td align="left" scope="row" colspan="7">
                    <b>Please enter details for WhatsApp :</b>
                </td>
            </tr>
            {if $survey_wp_fromdetails neq ''}
                {foreach from=$survey_wp_fromdetails key=key item=fromwpDetails}
                    {if $isWhatsppSet eq 1}
                        <tr class="survey_from_wp_details_tr" id="survey_from_wp_details_tr_{$key}">
                        {else}
                        <tr class="survey_from_wp_details_tr" id="survey_from_wp_details_tr_{$key}" style="display:none;">
                        {/if}
                        {if $key eq 1}
                            <td scope="row" class="form-heading-label">From WhatsApp Name: <span class="required">*</span></td>
                        {else}
                            <td scope="row" class="form-heading-label"></td>
                        {/if}
                        <td class="form-field"><input id="survey_wp_fromName_{$key}" placeholder="Enter Sender Information" name="survey_wp_fromName_{$key}" tabindex="1" size="25" maxlength="128" type="text" value="{$fromwpDetails.wpFromName}"></td>
                            {if $key eq 1}
                            <td scope="row" class="form-heading-label">From WhatsApp Phone Number: <span class="required">*</span></td>
                        {else}
                            <td scope="row" class="form-heading-label"></td>
                        {/if}
                        <td class="form-field"><input id="survey_wp_fromPhoneNumber_{$key}" name="survey_wp_fromPhoneNumber_{$key}" placeholder="Enter WhatsApp Mobile Number" tabindex="1" size="25" maxlength="128" type="text" value="{$fromwpDetails.wpFromPhoneNumber}"></td>
                            {if $fromwpDetails.defaultNumber eq 'default'}
                            <td class="form-field"><input type="radio" name="survey_wp_default_value" value="survey_wp_default_value_{$key}" checked style='margin-top:9px;'/></td>
                            {else}
                            <td class="form-field"><input type="radio" name="survey_wp_default_value" value="survey_wp_default_value_{$key}" style='margin-top:9px;'/></td>
                            {/if}
                            {if $survey_wp_fromdetailsLength gt 1}
                                {if $survey_wp_fromdetailsLength eq $key}
                                <td class="form-field"><input class="survey_wp_addMultiNumber" id="survey_wp_addMultiNumber_{$key}" name="survey_wp_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;" type="button" value="+" onclick="addMultipleNumberWp();"></td>
                                <td class="form-field"><input id="survey_wp_removeMultiNumber_{$key}" name="survey_wp_removeMultiNumber_{$key}" class="survey_wp_removeMultiNumber" style="height:28px;width:28px;cursor: pointer;" type="button" value="-" onclick="removeMultipleNumber(this);"></td>
                                {else}
                                <td class="form-field"><input class="survey_wp_addMultiNumber" id="survey_wp_addMultiNumber_{$key}" name="survey_wp_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;display: none;" type="button" value="+" onclick="addMultipleNumberWp();"></td>
                                    {if $key eq 1}
                                    <td class="form-field"></td>
                                {else}
                                    <td class="form-field"><input id="survey_wp_removeMultiNumber_{$key}" name="survey_wp_removeMultiNumber_{$key}" class="survey_wp_removeMultiNumber" style="height:28px;width:28px;cursor: pointer;" type="button" value="-" onclick="removeMultipleNumber(this);"></td>
                                    {/if}
                                {/if}
                            {else}
                            <td class="form-field"><input class="survey_wp_addMultiNumber" id="survey_wp_addMultiNumber_{$key}" name="survey_wp_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;" type="button" value="+" onclick="addMultipleNumberWp();"></td>
                            <td class="form-field"></td>
                        {/if}
                    </tr>
                {/foreach}
            {else}
                {if $isWhatsppSet eq 1}
                    <tr class="survey_from_wp_details_tr" id="survey_from_wp_details_tr_1">
                    {else}
                    <tr class="survey_from_wp_details_tr" id="survey_from_wp_details_tr_1" style="display:none;">
                    {/if}
                    <td scope="row" class="form-heading-label">From WhatsApp Name: <span class="required">*</span></td>
                    <td class="form-field"><input id="survey_wp_fromName_1" placeholder="Enter Sender Information" name="survey_wp_fromName_1" tabindex="1" size="25" maxlength="128" type="text" value=""></td>
                    <td scope="row" class="form-heading-label">From WhatsApp Phone Number: <span class="required">*</span></td>
                    <td class="form-field"><input id="survey_wp_fromPhoneNumber_1" name="survey_wp_fromPhoneNumber_1" placeholder="Enter WhatsApp Mobile Number" tabindex="1" size="25" maxlength="128" type="text" value=""></td>
                    <td class="form-field"><input type="radio" name="survey_wp_default_value" value="survey_wp_default_value_1" style='margin-top:9px;'/></td>
                    <td class="form-field"><input class="survey_wp_addMultiNumber" id="survey_wp_addMultiNumber_1" name="survey_wp_addMultiNumber_1" style="height:28px;width:28px;cursor: pointer;" type="button" value="+" onclick="addMultipleNumberWp();"></td>
                    <td class="form-field"></td>
                </tr>
            {/if}


        </tbody>
    </table>
    <input title="Save" accesskey="a" class="button primary" onclick="return survey_sms_verifyData();" type="button" name="button" id="btn_save" value="Save">
    <input title="Cancel" accesskey="l" class="button" onclick="gacktoadmin();" type="button" name="button" value="Cancel">

</form>
{literal}
    <script type="text/javascript">
        function gacktoadmin() {
            javascript:parent.DOTB.App.router.navigate("#bwc/index.php?module=Administration&action=index", {trigger: true});
        }
        function addMultipleNumber() {
            var trCount = $('.survey_from_sms_details_tr').length;
            var newtrCount = trCount + 1;
            $('.survey_sms_addMultiNumber').hide();
            var html = '';
            html += "<tr class='survey_from_sms_details_tr' id='survey_from_sms_details_tr_" + newtrCount + "'>";
            html += "<td scope='row' class='form-heading-label'></span></td>";
            html += "<td class='form-field'><input id='survey_sms_fromName_" + newtrCount + "' name='survey_sms_fromName_" + newtrCount + "' placeholder='Enter Sender Information' tabindex='1' size='25' maxlength='128' type='text' value=''></td>";

            //html += "<td scope='row' class='form-heading-label'>From SMS Phone Number: <span class='required'>*</span></td>";
            html += "<td scope='row' class='form-heading-label'></td>";
            html += "<td class='form-field'><input id='survey_sms_fromPhoneNumber_" + newtrCount + "' name='survey_sms_fromPhoneNumber_" + newtrCount + "' placeholder='Enter SMS Mobile Number' tabindex='1' size='25' maxlength='128' type='text' value=''></td>";
            html += "<td class='form-field'><input type='radio' name='survey_sms_default_value' value='survey_sms_default_value_" + newtrCount + "' style='margin-top:9px;'/></td>";

            html += "<td class='form-field'><input class='survey_sms_addMultiNumber' id='survey_sms_addMultiNumber_" + newtrCount + "' name='survey_sms_addMultiNumber_" + newtrCount + "' style='height:28px;width:28px;cursor: pointer;' type='button' value='+' onclick='addMultipleNumber();'></td>";
            html += "<td class='form-field'><input class='survey_sms_removeMultiNumber' id='survey_sms_removeMultiNumber_" + newtrCount + "' name='survey_sms_removeMultiNumber_" + newtrCount + "' style='height:28px;width:28px;cursor: pointer;' type='button' value='-' onclick='removeMultipleNumber(this);'></td>";

            html += "</tr>";

            $("#survey_from_sms_details_tr_" + trCount).after(html);
        }
        function addMultipleNumberWp() {
            var trCount = $('.survey_from_wp_details_tr').length;
            var newtrCount = trCount + 1;
            $('.survey_wp_addMultiNumber').hide();
            var html = '';
            html += "<tr class='survey_from_wp_details_tr' id='survey_from_wp_details_tr_" + newtrCount + "'>";
            html += "<td scope='row' class='form-heading-label'></span></td>";
            html += "<td class='form-field'><input id='survey_wp_fromName_" + newtrCount + "' name='survey_wp_fromName_" + newtrCount + "' placeholder='Enter Sender Information' tabindex='1' size='25' maxlength='128' type='text' value=''></td>";
//            html += "<td scope='row' class='form-heading-label'>From WhatsApp Phone Number: <span class='required'>*</span></td>";
            html += "<td scope='row' class='form-heading-label'></td>";
            html += "<td class='form-field'><input id='survey_wp_fromPhoneNumber_" + newtrCount + "' name='survey_wp_fromPhoneNumber_" + newtrCount + "' placeholder='Enter WhatsApp Mobile Number' tabindex='1' size='25' maxlength='128' type='text' value=''></td>";
            html += "<td class='form-field'><input type='radio' name='survey_wp_default_value' value='survey_wp_default_value_" + newtrCount + "' style='margin-top:9px;'/></td>";
            html += "<td class='form-field'><input class='survey_wp_addMultiNumber' id='survey_wp_addMultiNumber_" + newtrCount + "' name='survey_wp_addMultiNumber_" + newtrCount + "' style='height:28px;width:28px;cursor: pointer;' type='button' value='+' onclick='addMultipleNumberWp();'></td>";
            html += "<td class='form-field'><input class='survey_wp_removeMultiNumber' id='survey_wp_removeMultiNumber_" + newtrCount + "' name='survey_wp_removeMultiNumber_" + newtrCount + "' style='height:28px;width:28px;cursor: pointer;' type='button' value='-' onclick='removeMultipleNumber(this);'></td>";
            html += "</tr>";
            $("#survey_from_wp_details_tr_" + trCount).after(html);
        }
        function removeMultipleNumber(el) {
            if (confirm("Are you sure you want to remove?")) {
                var className = $(el).prop("class");
                var trId = $(el).parent().parent().prop('id');
                if (className == "survey_wp_removeMultiNumber") {
                    if ($(el).parent().parent().next('tr').length == 0) {
                        $(el).parent().parent().prev('tr').find('.survey_wp_addMultiNumber').show();
                    }
                }
                if (className == "survey_sms_removeMultiNumber") {
                    if ($(el).parent().parent().next('tr').prop("id") == "whatsappTr" || $(el).parent().parent().next('tr').prop("id") == "") {
                        $(el).parent().parent().prev('tr').find('.survey_sms_addMultiNumber').show();
                    }
                }
            }
            $("#" + trId).remove();

        }
        function survey_sms_verifyData() {
            var isError = false;
            var errorMessage = "";
            if (typeof document.forms['SurveySmsSettings'] != 'undefined') {
                //var sendType = 'SMTP';
                var smsSid = document.getElementById('survey_sms_sid').value;
                var smsToken = document.getElementById('survey_sms_smsToken').value;
                if (smsSid.trim() == "") {
                    isError = true;
                    errorMessage += "\nFrom Twilio id";
                }
                if (smsToken.trim() == "") {
                    isError = true;
                    errorMessage += "\nFrom Twilio Token";
                }
                var trCount = $('.survey_from_sms_details_tr').length;
                var trCountWp = $('.survey_from_wp_details_tr').length;
                var i = 0;
                var fromDetails = new Object();
                var FromAllDetails = new Object();
                var fromDetailsWp = new Object();
                var whatsappDetails = $("#whatsappDetails").prop("checked");
                var smsDetails = $("#smsDetails").prop("checked");
                var noDefault = 'true'
                var noDefaultWp = 'true'
                for (i = 1; i <= trCount; i++) {
                    var Details = new Object();
                    var fromName = (document.getElementById('survey_sms_fromName_' + i).value).trim();
                    var fromPhoneNumber = (document.getElementById('survey_sms_fromPhoneNumber_' + i).value).trim();
                    var defaultNumber = $('[name="survey_sms_default_value"]:checked').val();
                    var makeDefault = '';
                    if (defaultNumber == ("survey_sms_default_value_" + i)) {
                        makeDefault = "default";
                        noDefault = 'false';
                    } else {
                        makeDefault = "none";
                    }
                    Details['smsFromName'] = fromName;
                    Details['smsFromPhoneNumber'] = fromPhoneNumber;
                    Details['defaultNumber'] = makeDefault;
                    if (fromName.trim() == "" && smsDetails) {
                        isError = true;
                        errorMessage += "\nFrom SMS Name";
                    }
                    if (fromPhoneNumber.trim() == "" && smsDetails) {
                        isError = true;
                        errorMessage += "\nFrom SMS Phone Number";
                    }
                    fromDetails[i] = Details;
                }
                //For whatsapp
                for (i = 1; i <= trCountWp; i++) {
                    var Details = new Object();
                    var fromName = (document.getElementById('survey_wp_fromName_' + i).value).trim();
                    var fromPhoneNumber = (document.getElementById('survey_wp_fromPhoneNumber_' + i).value).trim();
                    //     var doNotReply = $('#survey_sms_doNotReply_' + i + ':checked').length;
                    var defaultNumber = $('[name="survey_wp_default_value"]:checked').val();
                    var makeDefault = '';
                    if (defaultNumber == ("survey_wp_default_value_" + i)) {
                        makeDefault = "default";
                        noDefaultWp = 'false';
                    } else {
                        makeDefault = "none";
                    }
                    Details['wpFromName'] = fromName;
                    Details['wpFromPhoneNumber'] = fromPhoneNumber;
//                    Details['smsDoNotReply'] = doNotReply;
                    Details['defaultNumber'] = makeDefault;
                    if (fromName.trim() == "" && whatsappDetails) {
                        isError = true;
                        errorMessage += "\nFrom WhatsApp Name";
                    }
                    if (fromPhoneNumber.trim() == "" && whatsappDetails) {
                        isError = true;
                        errorMessage += "\nFrom WhatsApp  Phone Number";
                    }
                    fromDetailsWp[i] = Details;
                }
                FromAllDetails['sms'] = fromDetails;
                FromAllDetails['whatsapp'] = fromDetailsWp;
            }

            if (errorMessage && isError)
            {
                errorMessage = 'Missing required field :  ' + errorMessage;
            }
            // Here we decide whether to submit the form.
            if (isError == true) {
                alert(errorMessage);
                return false;
            } else {
                var finalFromDetails = JSON.stringify(FromAllDetails);
                var url = app.api.buildURL("bc_survey", "save_surveysms_setting", "",
                        {
                            survey_sms_sid: smsSid,
                            survey_sms_token: smsToken,
                            survey_sms_fromdetails: finalFromDetails
                        });
                app.api.call("GET", url, {}, {
                    success: function (result) {
                        javascript:parent.DOTB.App.router.navigate("#bwc/index.php?module=Administration&action=index", {trigger: true});
                    }
                });
            }
            return true;
        }
        function ShowHideDetails(el, type) {
            
            var detailId = $(el).attr("id");
            if (type == "sms") {
                if ($("#" + detailId).prop("checked")) {
                    $(".sms_heading").show();
                    $(".survey_from_sms_details_tr").show();
                } else {
                    $(".sms_heading").hide();
                    $(".survey_from_sms_details_tr").hide();
                }
            } else if (type == "whatsapp") {
                if ($("#" + detailId).prop("checked")) {
                    $(".whatsapp_heading").show();
                    $(".survey_from_wp_details_tr").show();
                } else {
                    $(".whatsapp_heading").hide();
                    $(".survey_from_wp_details_tr").hide();
                }
            }
        }
    </script>
{/literal}