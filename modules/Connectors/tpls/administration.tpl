{*

*}
<link rel="stylesheet" type="text/css" href="{dotb_getjspath file='modules/Connectors/tpls/administration.css'}"/>

<table class='edit view small' width="100%" border="0" cellspacing="1" cellpadding="0" >
	<tr valign="top">
		<td width="35%">
			<table  border="0" cellspacing="2" cellpadding="0" >
				<tr valign='top'>
					<td><img src="{$IMG}icon_ConnectorConfig.gif" class="connector-img" name="connectorConfig" onclick="document.location.href='index.php?module=Connectors&action=ModifyProperties';"></td>
					<td>&nbsp;&nbsp;</td>
					<td><b>{$mod.LBL_MODIFY_PROPERTIES_TITLE}</b><br/>
						{$mod.LBL_MODIFY_PROPERTIES_DESC}
					</td>
				</tr>
				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>
				<tr valign='top'>
					<td><img src="{$IMG}icon_ConnectorEnable.gif" class="connector-img" name="enableImage" onclick="document.location.href='index.php?module=Connectors&action=ModifyDisplay';"></td>
					<td>&nbsp;&nbsp;</td>
					<td><b>{$mod.LBL_MODIFY_DISPLAY_TITLE}</b><br/>
						{$mod.LBL_MODIFY_DISPLAY_DESC}
					</td>
				</tr>
			</table>
		</td>
		<td width="10%">&nbsp;</td>
		<td width="35%">
			<table  border="0" cellspacing="2" cellpadding="0">
				<tr valign='top'>
					<td><img src="{$IMG}icon_ConnectorMap.gif" class="connector-img" name="connectorMapImg" onclick="document.location.href='index.php?module=Connectors&action=ModifyMapping';"></td>
					<td>&nbsp;&nbsp;</td>
					<td><b>{$mod.LBL_MODIFY_MAPPING_TITLE}</b><br/>
						{$mod.LBL_MODIFY_MAPPING_DESC}
					</td>
				</tr>

				<tr>
					<td colspan=2>&nbsp;</td>
				</tr>


				<tr valign='top'>
					<td>
					    <img src="{$IMG}icon_ConnectorSearchFields.gif" class="connector-img" name="connectorSearchImg" onclick="document.location.href='index.php?module=Connectors&action=ModifySearch';">
				    </td>
					<td>&nbsp;&nbsp;</td>
					<td>
					    {* BEGIN DOTBCRM flav=pro ONLY *}
					    <b>{$mod.LBL_MODIFY_SEARCH_TITLE}</b><br/>
						{$mod.LBL_MODIFY_SEARCH_DESC}
						{* END DOTBCRM flav=pro ONLY *}
					</td>
				</tr>

			</table>
		</td>
		<td width="20%">&nbsp;</td>
	</tr>
</table>
