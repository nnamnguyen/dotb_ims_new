{dotb_getscript file="custom/include/javascript/Selecttablelist/jquery.selectable-list.js"}

<div id="div_partnership" style="display: none;">
    <table id="tblpa" >
        <thead>
            <tr><td ><button class="button" type="button" id="btnAdd">Add</button></td></tr>
        </thead>
        <tbody id="tbodypa">
            {$PA}
        </tbody>
    </table>
</div>

<div id="div_hour" style="display: none;">
<table id="tblHourConfig" width="80%" border="1" class="list view">
    <thead>
        <tr><th colspan="3" align="center">Level discount by hour</th></tr>
        <tr>
            <th width="20%" style="text-align: center;">Tuition Hours</th>
            <th width="20%" style="text-align: center;">Promotion Hours</th>
            <td width="10%" style="text-align: center;"><button class="button" type="button" id="btnAddrowHour"><img src="themes/default/images/id-ff-add.png" alt="Add new"></button></td></td>
        </tr>
    </thead>
    <tbody id="tbodyHourConfig">
    {$DIH}
    </tbody>
</table>
</div>



