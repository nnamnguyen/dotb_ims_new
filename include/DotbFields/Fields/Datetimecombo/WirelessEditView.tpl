{*

*}
<input type="hidden" name="wl_datetime" value="true" />
<input type="hidden" name="field_name" value="{$vardef.name}" />
{html_select_date prefix="wl_date_" time=$date_start month_format="%m" end_year="+5" field_order=$field_order}<br />
{html_select_time prefix="wl_time_" time=$time_start use_24_hours=$use_meridian display_seconds=false minute_interval="15"}