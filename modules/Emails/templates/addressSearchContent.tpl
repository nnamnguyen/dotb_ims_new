{*

*}
<div id="contactsDialogue"></div>
<div id="contactsDialogueHTML" class="yui-hidden">
	<div id="contactsDialogueBody">
		<div id='addressBookTabsDiv'></div>
		<div id='contactsSearchTabs'>
		  {include file="modules/Emails/templates/addressSearch.tpl"}
		</div>
		
        <table >
        <tr>
            <td width="60%">
                <div id="addrSearchGrid" ></div>
	           <div id='dt-pag-nav-addressbook'></div>
	        </td>
	        <td width="3%">
	           <span style="position:relative; top:1px;">&nbsp;
	               <div style="overflow: visible; height: 0; position: absolute; width: 0; right:-2em; top:-166px;">
	                   <h3 style="">{dotb_translate label="LBL_SELECTED_ADDR" module="Emails"}:</h3>
	               </div>
	           </span>
	        </td>
	        <td width="37%"valign="top">
	           <div id="addrSearchResultGrid"></div>
	           <div class="yui-pg-container">&nbsp;</div>
	         </td>
        </tr>
        </table>
	    
    </div>
</div>